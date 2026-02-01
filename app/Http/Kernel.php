<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     * These run on every request.
     */
    protected $middleware = [
        // Handle trusted proxies
        \App\Http\Middleware\TrustProxies::class,

        

        // Prevent requests during maintenance
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,

        // Validate max POST size
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        // Trim strings from request inputs
        \App\Http\Middleware\TrimStrings::class,

        // Convert empty strings to null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Middleware groups.
     */
    protected $middlewareGroups = [
        'web' => [
            // Encrypt cookies
            \App\Http\Middleware\EncryptCookies::class,

            // Add cookies to response
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,

            // Start session
            \Illuminate\Session\Middleware\StartSession::class,

            // Share validation errors to views
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            // CSRF protection
            \App\Http\Middleware\VerifyCsrfToken::class,

            // Route model binding
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Route middleware.
     * Apply these individually to routes.
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,       // Check if user is logged in
        'admin' => \App\Http\Middleware\AdminMiddleware::class,  // Check if user is admin
        'customer' => \App\Http\Middleware\ApiCustomerMiddleware::class, // Customer-specific API middleware
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
    
}
