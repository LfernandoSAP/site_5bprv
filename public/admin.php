<?php

// Rewrite request so Laravel sees /admin instead of /admin.php
$_SERVER['REQUEST_URI']     = preg_replace('#/admin\.php(/|$)#', '/admin$1', $_SERVER['REQUEST_URI'] ?? '/admin');
$_SERVER['SCRIPT_NAME']     = str_replace('/admin.php', '/index.php', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
$_SERVER['PHP_SELF']        = str_replace('/admin.php', '/index.php', $_SERVER['PHP_SELF'] ?? '/index.php');
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/index.php';

require __DIR__ . '/index.php';
