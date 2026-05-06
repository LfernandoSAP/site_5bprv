<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRouteProxy
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $response->isRedirect()) {
            return $response;
        }

        $location = $response->headers->get('Location', '');
        $appUrl    = rtrim(config('app.url'), '/');

        if (str_starts_with($location, $appUrl . '/admin') && ! str_contains($location, '.php')) {
            $path        = ltrim(str_replace($appUrl . '/', '', $location), '/');
            $newLocation = $appUrl . '/admin-go.php?path=' . urlencode($path);
            $response->headers->set('Location', $newLocation);
        }

        return $response;
    }
}
