<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Middlewares globais da aplicação
    protected $middleware = [
        // Outros middlewares globais...
        // \App\Http\Middleware\ACLMiddleware::class, // se quiser global
    ];

    // Middlewares de grupos (web, api)
    protected $middlewareGroups = [
        'web' => [
            // Middlewares do grupo web
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // Se quiser usar acl global na api, pode colocar aqui
            // \App\Http\Middleware\ACLMiddleware::class,
        ],
    ];

    // Middlewares que podem ser usados por alias nas rotas
    protected $routeMiddleware = [
         'acl' => \App\Http\Middleware\ACLMiddleware::class,
        // outros aliases...
    ];
}