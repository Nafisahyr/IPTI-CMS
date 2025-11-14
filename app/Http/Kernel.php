<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     */
    protected $middleware = [
        \App\Http\Middleware\CorsMiddleware::class,
        // middleware lain nanti bisa ditambah di sini
    ];

    protected $middlewareGroups = [
        'web' => [],
        'api' => [],
    ];
}
