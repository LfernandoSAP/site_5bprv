<?php

if (! function_exists('ag')) {
    function ag(string $path): string
    {
        return url('admin-go.php') . '?path=' . urlencode('admin/' . ltrim($path, '/'));
    }
}

if (! function_exists('admin_redirect')) {
    function admin_redirect(string $route, mixed $params = [], ?string $message = null): \Illuminate\Http\RedirectResponse
    {
        $path = ltrim(route($route, $params, false), '/');
        $redirect = redirect(url('admin-go.php') . '?path=' . urlencode($path));
        return $message ? $redirect->with('status', $message) : $redirect;
    }
}
