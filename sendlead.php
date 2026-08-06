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

if ($name === '' || $phone === '') {
    http_response_code(400);
    echo 'Please include your name and phone number, then try again.';
    exit;
}

$config = mhp_load_mail_config();
if ($config === null) {
    http_response_code(500);
    echo 'Email is not configured yet. Upload includes/mail-config.php with your mailbox password.';
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
$smtpError = null;
$sent = mhp_smtp_send($config, $recipients, $subject, $body, $replyTo, $smtpError);

if (!$sent) {
    http_response_code(500);
    echo '<h2>Email could not be sent</h2>';
    echo '<p>Please call <a href="tel:+12696518149">(269) 651-8149</a> or try again shortly.</p>';
    if (!empty($config['debug'])) {
        echo '<p><strong>Debug:</strong> ' . htmlspecialchars((string) $smtpError, ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p>Check: mailbox exists, password matches Roundcube login, host is <code>server363.web-hosting.com</code>, username is full email.</p>';
    }
    exit;
}

header('Location: thank-you');
exit;
