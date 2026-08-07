<?php
/**
 * Site path helpers.
 * $base = relative prefix for assets from the current page ('' or '../').
 * $home = absolute-from-web-root URL to the homepage (always correct from any page).
 */
if (!isset($base)) {
    $base = '';
}

if (!isset($home)) {
    $scriptName = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? ''));
    $dir = str_replace('\\', '/', dirname($scriptName));

    // Pages inside /communities/ live one level below the site root
    if (basename($dir) === 'communities') {
        $dir = dirname($dir);
    }

    $dir = rtrim($dir, '/');
    $home = ($dir === '' || $dir === '.') ? '/' : $dir . '/';
}
