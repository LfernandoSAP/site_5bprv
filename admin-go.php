<?php
// Universal admin router — rewrites REQUEST_URI before bootstrapping Laravel
$path = urldecode($_GET['path'] ?? 'admin');
$path = strtok($path, '?');

$_SERVER['REQUEST_URI'] = '/unidades/5bprv/' . ltrim($path, '/');

unset($_GET['path']);
$_SERVER['QUERY_STRING'] = !empty($_GET) ? http_build_query($_GET) : '';
if (!empty($_SERVER['QUERY_STRING'])) {
    $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
}

require __DIR__ . '/index.php';
