<?php
/**
 * Copy to mail-config.php and set the real mailbox password.
 *
 * Namecheap often blocks direct form mail to Gmail as spam.
 * Send to leads@mhpcommunities.com only, then add a cPanel Email Forwarder
 * to your Gmail address.
 */
return [
    'host'       => 'server363.web-hosting.com',
    'port'       => 465,
    'encryption' => 'ssl',
    'username'   => 'leads@mhpcommunities.com',
    'password'   => 'CHANGE_ME_TO_MAILBOX_PASSWORD',

    'from_email' => 'leads@mhpcommunities.com',
    'from_name'  => 'MHP Communities',

    'recipients' => 'leads@mhpcommunities.com',

    'debug'      => false,
];
