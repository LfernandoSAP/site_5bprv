<?php

$slug = (string) ($_GET['slug'] ?? '');

if (! preg_match('/^[a-z0-9-]+$/', $slug)) {
    http_response_code(404);
    exit;
}

$_SERVER['REQUEST_URI'] = '/unidades/5bprv/publicacoes/'.rawurlencode($slug);

unset($_GET['slug']);
$_SERVER['QUERY_STRING'] = ! empty($_GET) ? http_build_query($_GET) : '';

require __DIR__.'/index.php';
