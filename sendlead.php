<?php
// MHP Communities lead handler — sends via SMTP (same as Roundcube), then thank-you page.
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

if ($name === '' || $phone === '') {
    http_response_code(400);
    echo 'Please include your name and phone number, then try again.';
    exit;
}

$config = mhp_load_mail_config();
if ($config === null) {
    http_response_code(500);
    echo 'Email is not configured yet. Copy includes/mail-config.example.php to includes/mail-config.php and set the mailbox password.';
    exit;
}

$recipients = $config['recipients'] ?? '';
if ($recipients === '') {
    http_response_code(500);
    echo 'No lead recipients configured.';
    exit;
}

$subject = 'WEBSITE LEAD' . ($park ? " - $park" : '') . " - $name";
$body  = "New lead from mhpcommunities.com\n\n";
$body .= "Name:      $name\n";
$body .= "Phone:     $phone\n";
$body .= 'Email:     ' . ($email ?: '(not provided)') . "\n";
$body .= 'Community: ' . ($park ?: '(not specified)') . "\n\n";
$body .= "Message:\n" . ($message ?: '(none)') . "\n\n";
$body .= "Follow-up SLA: call or text back the same business day.\n";

$replyTo = ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) ? $email : '';
$sent = mhp_smtp_send($config, $recipients, $subject, $body, $replyTo);

if (!$sent) {
    // Last-resort fallback (often blocked on shared hosting)
    $headers = 'From: ' . ($config['from_email'] ?? 'leads@mhpcommunities.com') . "\r\n";
    if ($replyTo) {
        $headers .= "Reply-To: $replyTo\r\n";
    }
    $sent = @mail($recipients, $subject, $body, $headers);
}

if (!$sent) {
    http_response_code(500);
    echo 'Sorry — we could not send your message right now. Please call (269) 651-8149 or try again shortly.';
    exit;
}

header('Location: thank-you');
exit;
