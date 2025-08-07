<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ACLMiddleware;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::aliasMiddleware('acl', ACLMiddleware::class);
    }

    public function register()
    {
        //
    }
}