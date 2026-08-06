<?php
/**
 * Send email through authenticated SMTP (Namecheap / cPanel Roundcube mailbox).
 * Supports plain text + optional HTML (multipart/alternative).
 */
function mhp_load_mail_config()
{
    $path = __DIR__ . '/mail-config.php';
    if (!is_file($path)) {
        return null;
    }
    $config = include $path;
    return is_array($config) ? $config : null;
}

function mhp_smtp_send(array $config, $to, $subject, $bodyText, $replyTo = '', &$error = null, $bodyHtml = '')
{
    $error = null;
    $host = $config['host'] ?? '';
    $port = (int) ($config['port'] ?? 465);
    $encryption = strtolower((string) ($config['encryption'] ?? 'ssl'));
    $username = $config['username'] ?? '';
    $password = $config['password'] ?? '';
    $fromEmail = $config['from_email'] ?? $username;
    $fromName = $config['from_name'] ?? 'Website';

    if ($host === '' || $username === '' || $password === '' || $password === 'CHANGE_ME_TO_MAILBOX_PASSWORD') {
        $error = 'Mailbox password is not set in includes/mail-config.php';
        return false;
    }

    $remote = ($encryption === 'ssl' ? 'ssl://' : '') . $host;
    $errno = 0;
    $errstr = '';
    $context = stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ],
    ]);

    $fp = @stream_socket_client(
        $remote . ':' . $port,
        $errno,
        $errstr,
        30,
        STREAM_CLIENT_CONNECT,
        $context
    );

    if (!$fp) {
        $error = "Cannot connect to SMTP $host:$port — $errstr ($errno)";
        error_log('MHP SMTP connect failed: ' . $error);
        return false;
    }

    stream_set_timeout($fp, 30);

    $read = function () use ($fp) {
        $data = '';
        while ($line = fgets($fp, 515)) {
            $data .= $line;
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }
        return $data;
    };

    $write = function ($cmd) use ($fp) {
        fwrite($fp, $cmd . "\r\n");
    };

    $expect = function ($response, $codes) {
        $code = (int) substr($response, 0, 3);
        return in_array($code, (array) $codes, true);
    };

    $normalize = function ($text) {
        $text = str_replace(["\r\n", "\r"], "\n", (string) $text);
        $text = preg_replace('/^\./m', '..', $text);
        return str_replace("\n", "\r\n", $text);
    };

    try {
        $banner = $read();
        if (!$expect($banner, 220)) {
            throw new RuntimeException('Bad SMTP banner: ' . trim($banner));
        }

        $write('EHLO mhpcommunities.com');
        $ehlo = $read();
        if (!$expect($ehlo, 250)) {
            $write('HELO mhpcommunities.com');
            $ehlo = $read();
            if (!$expect($ehlo, 250)) {
                throw new RuntimeException('EHLO/HELO failed: ' . trim($ehlo));
            }
        }

        if ($encryption === 'tls') {
            $write('STARTTLS');
            $tls = $read();
            if (!$expect($tls, 220)) {
                throw new RuntimeException('STARTTLS failed: ' . trim($tls));
            }
            if (!stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                throw new RuntimeException('TLS negotiation failed');
            }
            $write('EHLO mhpcommunities.com');
            $ehlo = $read();
            if (!$expect($ehlo, 250)) {
                throw new RuntimeException('EHLO after TLS failed: ' . trim($ehlo));
            }
        }

        $write('AUTH LOGIN');
        if (!$expect($read(), 334)) {
            throw new RuntimeException('AUTH LOGIN not accepted');
        }
        $write(base64_encode($username));
        if (!$expect($read(), 334)) {
            throw new RuntimeException('SMTP username rejected — check username in mail-config.php');
        }
        $write(base64_encode($password));
        if (!$expect($read(), 235)) {
            throw new RuntimeException('SMTP password rejected — wrong mailbox password for ' . $username);
        }

        $write('MAIL FROM:<' . $fromEmail . '>');
        if (!$expect($read(), 250)) {
            throw new RuntimeException('MAIL FROM rejected for ' . $fromEmail);
        }

        $toList = array_filter(array_map('trim', explode(',', $to)));
        foreach ($toList as $addr) {
            $write('RCPT TO:<' . $addr . '>');
            if (!$expect($read(), [250, 251])) {
                throw new RuntimeException('RCPT TO rejected: ' . $addr);
            }
        }

        $write('DATA');
        if (!$expect($read(), 354)) {
            throw new RuntimeException('DATA not accepted');
        }

        $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $msgId = sprintf('<%s@%s>', bin2hex(random_bytes(12)), 'mhpcommunities.com');
        $headers = [];
        $headers[] = 'Date: ' . date('r');
        $headers[] = 'From: ' . sprintf('"%s" <%s>', addcslashes($fromName, '"\\'), $fromEmail);
        $headers[] = 'To: ' . implode(', ', $toList);
        $headers[] = 'Subject: ' . $encodedSubject;
        $headers[] = 'Message-ID: ' . $msgId;
        $headers[] = 'MIME-Version: 1.0';
        if ($replyTo && filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
            $headers[] = 'Reply-To: ' . $replyTo;
        }

        if ($bodyHtml !== '') {
            $boundary = 'b_' . bin2hex(random_bytes(8));
            $headers[] = 'Content-Type: multipart/alternative; boundary="' . $boundary . '"';
            $payload  = 'This is a multi-part message in MIME format.' . "\r\n\r\n";
            $payload .= '--' . $boundary . "\r\n";
            $payload .= "Content-Type: text/plain; charset=UTF-8\r\n";
            $payload .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
            $payload .= $normalize($bodyText) . "\r\n\r\n";
            $payload .= '--' . $boundary . "\r\n";
            $payload .= "Content-Type: text/html; charset=UTF-8\r\n";
            $payload .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
            $payload .= $normalize($bodyHtml) . "\r\n\r\n";
            $payload .= '--' . $boundary . '--';
        } else {
            $headers[] = 'Content-Type: text/plain; charset=UTF-8';
            $headers[] = 'Content-Transfer-Encoding: 8bit';
            $payload = $normalize($bodyText);
        }

        $message = implode("\r\n", $headers) . "\r\n\r\n" . $payload . "\r\n.";
        $write($message);
        if (!$expect($read(), 250)) {
            throw new RuntimeException('Message not accepted by mail server');
        }

        $write('QUIT');
        fclose($fp);
        return true;
    } catch (Throwable $e) {
        $error = $e->getMessage();
        error_log('MHP SMTP send failed: ' . $error);
        fclose($fp);
        return false;
    }
}

/**
 * Build a clean HTML lead notification email.
 */
function mhp_lead_email_html(array $data)
{
    $e = static function ($v) {
        return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
    };

    $name = $e($data['name'] ?? '');
    $phone = $e($data['phone'] ?? '');
    $email = $e($data['email'] ?? 'Not provided');
    $park = $e($data['park'] ?? 'Not specified');
    $message = nl2br($e($data['message'] ?? 'No message provided.'));
    $when = $e($data['when'] ?? date('F j, Y g:i A T'));

    return '<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>New website inquiry</title></head>
<body style="margin:0;padding:0;background:#eef2f6;font-family:Arial,Helvetica,sans-serif;color:#1c2430;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#eef2f6;padding:24px 12px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:600px;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #dbe3ec;">
          <tr>
            <td style="background:#0b3d5c;padding:22px 28px;">
              <div style="font-size:13px;letter-spacing:.08em;text-transform:uppercase;color:#f0c75e;font-weight:700;">MHP Communities</div>
              <div style="font-size:22px;line-height:1.3;color:#ffffff;font-weight:700;margin-top:6px;">New website inquiry</div>
            </td>
          </tr>
          <tr>
            <td style="padding:24px 28px 8px;font-size:15px;line-height:1.6;color:#334155;">
              A visitor submitted the contact form on <strong>mhpcommunities.com</strong>.
            </td>
          </tr>
          <tr>
            <td style="padding:8px 28px 24px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;">
                <tr>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;width:34%;color:#64748b;font-size:13px;font-weight:700;">Name</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#0f172a;font-size:15px;">' . $name . '</td>
                </tr>
                <tr>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#64748b;font-size:13px;font-weight:700;">Phone</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#0f172a;font-size:15px;">' . $phone . '</td>
                </tr>
                <tr>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#64748b;font-size:13px;font-weight:700;">Email</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#0f172a;font-size:15px;">' . $email . '</td>
                </tr>
                <tr>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#64748b;font-size:13px;font-weight:700;">Community</td>
                  <td style="padding:12px 16px;border-bottom:1px solid #e2e8f0;color:#0f172a;font-size:15px;">' . $park . '</td>
                </tr>
                <tr>
                  <td style="padding:12px 16px;color:#64748b;font-size:13px;font-weight:700;vertical-align:top;">Message</td>
                  <td style="padding:12px 16px;color:#0f172a;font-size:15px;line-height:1.55;">' . $message . '</td>
                </tr>
              </table>
              <p style="margin:16px 0 0;font-size:12px;color:#94a3b8;">Submitted: ' . $when . '</p>
            </td>
          </tr>
          <tr>
            <td style="background:#f8fafc;padding:16px 28px;border-top:1px solid #e2e8f0;font-size:12px;color:#64748b;">
              Reply directly to this email if the visitor provided an address.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>';
}
