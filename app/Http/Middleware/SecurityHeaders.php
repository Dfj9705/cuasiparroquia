<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // $isLocal = app()->environment('local');

        // $csp = "default-src 'self'; " .
        //     "script-src 'self' 'unsafe-inline' 'unsafe-eval'" .
        //     ($isLocal ? " http://localhost:5173 http://127.0.0.1:5173 http://[::1]:5173" : "") . "; " .
        //     "style-src 'self' 'unsafe-inline'" .
        //     ($isLocal ? " http://localhost:5173 http://127.0.0.1:5173 http://[::1]:5173" : "") . "; " .
        //     "img-src 'self' data: blob:; " .
        //     "font-src 'self' data:; " .
        //     "connect-src 'self'" .
        //     ($isLocal ? " http://localhost:5173 http://127.0.0.1:5173 http://[::1]:5173 ws://localhost:5173 ws://127.0.0.1:5173 ws://[::1]:5173" : "") . "; " .
        //     "frame-ancestors 'self';";

        // $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}