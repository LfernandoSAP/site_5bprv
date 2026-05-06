<?php

// Rewrite request so Laravel sees /login instead of /login.php
$_SERVER['REQUEST_URI']     = preg_replace('#/login\.php(/|$)#', '/login$1', $_SERVER['REQUEST_URI'] ?? '/login');
$_SERVER['SCRIPT_NAME']     = str_replace('/login.php', '/index.php', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
$_SERVER['PHP_SELF']        = str_replace('/login.php', '/index.php', $_SERVER['PHP_SELF'] ?? '/index.php');
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/index.php';

require __DIR__ . '/index.php';
