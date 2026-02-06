<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // User must be logged in
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // User must be admin
        if (auth()->User()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
