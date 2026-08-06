<?php
/**
 * Copy this file to mail-config.php and fill in your cPanel mailbox password.
 * mail-config.php is gitignored so the password is not committed.
 *
 * Use the same mailbox you use in Roundcube (e.g. leads@mhpcommunities.com).
 */
return [
    // Namecheap / cPanel SMTP
    'host'       => 'mail.mhpcommunities.com',
    'port'       => 465,          // 465 = SSL, or use 587 with 'encryption' => 'tls'
    'encryption' => 'ssl',        // 'ssl' or 'tls'
    'username'   => 'leads@mhpcommunities.com',
    'password'   => 'leads@mhpcommunities',

    // Shown as the From address (must match the mailbox above)
    'from_email' => 'leads@mhpcommunities.com',
    'from_name'  => 'MHP Communities Website',

    // Who receives website leads (comma-separated)
    'recipients' => 'hassannasir6321@gmail.com',
    // Production example:
    // 'recipients' => 'Melissa.Wing@sweetlake.net, aqsa.sadiq0@gmail.com',
];
