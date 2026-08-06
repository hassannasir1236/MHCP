<?php
// MHP Communities lead handler - posts form to email, redirects to thank-you page.
if ($_SERVER["REQUEST_METHOD"] != "POST") { header("Location: ./"); exit; }

$name    = str_replace(array("\r","\n"), " ", strip_tags(trim($_POST["name"] ?? "")));
$phone   = str_replace(array("\r","\n"), " ", strip_tags(trim($_POST["phone"] ?? "")));
$email   = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
$park    = str_replace(array("\r","\n"), " ", strip_tags(trim($_POST["park"] ?? "")));
$message = strip_tags(trim($_POST["message"] ?? ""));

if (empty($name) || empty($phone)) {
    http_response_code(400);
    echo "Please include your name and phone number, then try again.";
    exit;
}

// ===== RECIPIENTS - edit here if lead routing changes =====
$recipients = "Melissa.Wing@sweetlake.net, aqsa.sadiq0@gmail.com";

$subject = "WEBSITE LEAD" . ($park ? " - $park" : "") . " - $name";
$body  = "New lead from mhpcommunities.com\n\n";
$body .= "Name:      $name\n";
$body .= "Phone:     $phone\n";
$body .= "Email:     " . ($email ?: "(not provided)") . "\n";
$body .= "Community: " . ($park ?: "(not specified)") . "\n\n";
$body .= "Message:\n" . ($message ?: "(none)") . "\n\n";
$body .= "Follow-up SLA: call or text back the same business day.\n";

$headers = "From: leads@mhpcommunities.com\r\n";
if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $headers .= "Reply-To: $email\r\n";
}

@mail($recipients, $subject, $body, $headers);

// Redirect to thank-you page (fires the Meta Pixel Lead event)
header("Location: thank-you");
exit;
?>
