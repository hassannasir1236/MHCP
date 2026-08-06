<?php
/**
 * Copy to mail-config.php and set the real mailbox password.
 * Use the same login as Roundcube for leads@mhpcommunities.com
 */
return [
    // If this fails, keep server363.web-hosting.com (recommended on Namecheap)
    'host'       => 'server363.web-hosting.com',
    'port'       => 465,
    'encryption' => 'ssl',
    'username'   => 'leads@mhpcommunities.com',
    'password'   => 'CHANGE_ME_TO_MAILBOX_PASSWORD',

    'from_email' => 'leads@mhpcommunities.com',
    'from_name'  => 'MHP Communities Website',

    'recipients' => 'hassannasir6321@gmail.com',
    // 'recipients' => 'Melissa.Wing@sweetlake.net, aqsa.sadiq0@gmail.com',

    // true = show SMTP error after form submit (set false after it works)
    'debug'      => true,
];
