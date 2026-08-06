<?php
/**
 * Send email through authenticated SMTP (Namecheap / cPanel Roundcube mailbox).
 * PHP mail() is unreliable on shared hosting; SMTP matches what Roundcube uses.
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

function mhp_smtp_send(array $config, $to, $subject, $body, $replyTo = '')
{
    $host = $config['host'] ?? '';
    $port = (int) ($config['port'] ?? 465);
    $encryption = strtolower((string) ($config['encryption'] ?? 'ssl'));
    $username = $config['username'] ?? '';
    $password = $config['password'] ?? '';
    $fromEmail = $config['from_email'] ?? $username;
    $fromName = $config['from_name'] ?? 'Website';

    if ($host === '' || $username === '' || $password === '' || $password === 'CHANGE_ME_TO_MAILBOX_PASSWORD') {
        return false;
    }

    $remote = ($encryption === 'ssl' ? 'ssl://' : '') . $host;
    $errno = 0;
    $errstr = '';
    $fp = @stream_socket_client(
        $remote . ':' . $port,
        $errno,
        $errstr,
        30,
        STREAM_CLIENT_CONNECT,
        stream_context_create([
            'ssl' => [
                'verify_peer' => true,
                'verify_peer_name' => true,
                'allow_self_signed' => false,
            ],
        ])
    );

    if (!$fp) {
        // Retry without strict SSL verify (some shared hosts use mismatched cert CN)
        $fp = @stream_socket_client(
            $remote . ':' . $port,
            $errno,
            $errstr,
            30,
            STREAM_CLIENT_CONNECT,
            stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ])
        );
    }

    if (!$fp) {
        error_log("MHP SMTP connect failed: $errstr ($errno)");
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
            throw new RuntimeException('SMTP username rejected');
        }
        $write(base64_encode($password));
        if (!$expect($read(), 235)) {
            throw new RuntimeException('SMTP password rejected');
        }

        $write('MAIL FROM:<' . $fromEmail . '>');
        if (!$expect($read(), 250)) {
            throw new RuntimeException('MAIL FROM rejected');
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
        $headers = [];
        $headers[] = 'Date: ' . date('r');
        $headers[] = 'From: ' . sprintf('"%s" <%s>', addcslashes($fromName, '"'), $fromEmail);
        $headers[] = 'To: ' . implode(', ', $toList);
        $headers[] = 'Subject: ' . $encodedSubject;
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-Type: text/plain; charset=UTF-8';
        $headers[] = 'Content-Transfer-Encoding: 8bit';
        $headers[] = 'X-Mailer: MHP-Communities-SMTP';
        if ($replyTo && filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
            $headers[] = 'Reply-To: ' . $replyTo;
        }

        // Dot-stuff body lines that start with .
        $safeBody = preg_replace('/^\./m', '..', str_replace(["\r\n", "\r"], "\n", $body));
        $safeBody = str_replace("\n", "\r\n", $safeBody);

        $message = implode("\r\n", $headers) . "\r\n\r\n" . $safeBody . "\r\n.";
        $write($message);
        if (!$expect($read(), 250)) {
            throw new RuntimeException('Message not accepted');
        }

        $write('QUIT');
        fclose($fp);
        return true;
    } catch (Throwable $e) {
        error_log('MHP SMTP send failed: ' . $e->getMessage());
        fclose($fp);
        return false;
    }
}
