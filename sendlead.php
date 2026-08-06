<?php
// MHP Communities lead handler — SMTP only (same auth as Roundcube).
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ./');
    exit;
}

require_once __DIR__ . '/includes/smtp_mail.php';

$name    = str_replace(["\r", "\n"], ' ', strip_tags(trim($_POST['name'] ?? '')));
$phone   = str_replace(["\r", "\n"], ' ', strip_tags(trim($_POST['phone'] ?? '')));
$email   = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$park    = str_replace(["\r", "\n"], ' ', strip_tags(trim($_POST['park'] ?? '')));
$message = strip_tags(trim($_POST['message'] ?? ''));

/**
 * Simple status page so submit always shows sent / not sent + issue text.
 */
function mhp_lead_status_page($ok, $title, $messageHtml, $detail = '')
{
    $color = $ok ? '#0a7a3e' : '#b00020';
    $badge = $ok ? 'Email sent' : 'Email not sent';
    header('Content-Type: text/html; charset=UTF-8');
    if (!$ok) {
        http_response_code(500);
    }
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</title>';
    echo '<style>
      body{font-family:Arial,sans-serif;background:#f5f7fa;margin:0;padding:40px 16px;color:#1a1a1a}
      .box{max-width:560px;margin:0 auto;background:#fff;border-radius:10px;padding:28px;box-shadow:0 2px 12px rgba(0,0,0,.08)}
      .badge{display:inline-block;padding:6px 12px;border-radius:999px;color:#fff;background:' . $color . ';font-weight:700;font-size:14px;margin-bottom:14px}
      h1{margin:0 0 12px;font-size:24px}
      p{line-height:1.5}
      .detail{margin-top:16px;padding:12px;background:#f8f8f8;border-left:4px solid ' . $color . ';font-size:14px;word-break:break-word}
      a.btn{display:inline-block;margin-top:18px;margin-right:10px;padding:10px 16px;background:#0b3d5c;color:#fff;text-decoration:none;border-radius:6px}
    </style></head><body><div class="box">';
    echo '<div class="badge">' . htmlspecialchars($badge, ENT_QUOTES, 'UTF-8') . '</div>';
    echo '<h1>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h1>';
    echo $messageHtml;
    if ($detail !== '') {
        echo '<div class="detail"><strong>Issue:</strong> ' . htmlspecialchars($detail, ENT_QUOTES, 'UTF-8') . '</div>';
    }
    echo '<p>';
    if ($ok) {
        echo '<a class="btn" href="./#homes">Back to homes</a>';
        echo '<a class="btn" href="thank-you">Continue</a>';
    } else {
        echo '<a class="btn" href="contact">Try contact form again</a>';
        echo '<a class="btn" href="tel:+12696518149">Call (269) 651-8149</a>';
    }
    echo '</p></div></body></html>';
    exit;
}

if ($name === '' || $phone === '') {
    mhp_lead_status_page(
        false,
        'Missing required fields',
        '<p>Please include your name and phone number, then try again.</p>',
        'Name or phone was empty.'
    );
}

$config = mhp_load_mail_config();
if ($config === null) {
    mhp_lead_status_page(
        false,
        'Email is not configured',
        '<p>Upload <code>includes/mail-config.php</code> with your mailbox password.</p>',
        'mail-config.php is missing on the server.'
    );
}

$recipients = $config['recipients'] ?? '';
if ($recipients === '') {
    mhp_lead_status_page(
        false,
        'No recipient configured',
        '<p>Add at least one email in <code>recipients</code> inside mail-config.php.</p>',
        'recipients is empty.'
    );
}

// Soft wording — host spam filters flag ALL-CAPS subjects like "WEBSITE LEAD"
$subjectParts = ['Home inquiry'];
if ($park !== '') {
    $subjectParts[] = $park;
}
$subjectParts[] = $name;
$subject = implode(' - ', $subjectParts);

$placeholderHints = [
    "Tell us what you're looking for - we'll call or text you back the same business day.",
    "e.g. 2-3 bedrooms, move-in by fall, budget around \$20k",
];
if (in_array($message, $placeholderHints, true)) {
    $message = '';
}

$body  = "Hello,\n\n";
$body .= "Someone submitted the contact form on mhpcommunities.com.\n\n";
$body .= "Name: $name\n";
$body .= "Phone: $phone\n";
$body .= 'Email: ' . ($email !== '' ? $email : 'Not provided') . "\n";
$body .= 'Community: ' . ($park !== '' ? $park : 'Not specified') . "\n\n";
$body .= "Their message:\n";
$body .= ($message !== '' ? $message : 'No message provided.') . "\n\n";
$body .= "Please reply to the visitor if an email address was provided.\n";
$body .= "— MHP Communities website\n";

$replyTo = ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) ? $email : '';
$smtpError = null;
$sent = mhp_smtp_send($config, $recipients, $subject, $body, $replyTo, $smtpError);

if (!$sent) {
    mhp_lead_status_page(
        false,
        'Email was not sent',
        '<p>Your form was received by the website, but the email could not be delivered through SMTP.</p>
         <p>Check mailbox password / Roundcube login for <strong>leads@mhpcommunities.com</strong>, then try again.</p>',
        $smtpError ?: 'Unknown SMTP error'
    );
}

// Success: go to thank-you page (Meta Pixel Lead event)
header('Location: thank-you?sent=1');
exit;
