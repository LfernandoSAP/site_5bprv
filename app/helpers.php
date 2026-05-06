<?php

if (! function_exists('ag')) {
    function ag(string $path): string
    {
        return url('admin-go.php') . '?path=' . urlencode('admin/' . ltrim($path, '/'));
    }
}
