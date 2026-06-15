<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

    // PENGECEKAN KEAMANAN:

        if (auth()->check() &&
            auth()->user()->role == 'admin') {

            return $next($request);
        }

        abort(403);
    }
}