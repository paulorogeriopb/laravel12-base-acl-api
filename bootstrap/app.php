<?php

use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(function () {
        Route::middleware('api')->group(base_path('routes/api.php'));
        // Route::middleware('web')->group(base_path('routes/web.php'));
    })


    ->withMiddleware(function (Middleware $middleware): void {
          $middleware->alias([
        'acl' => \App\Http\Middleware\ACLMiddleware::class,
    ]);

    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();