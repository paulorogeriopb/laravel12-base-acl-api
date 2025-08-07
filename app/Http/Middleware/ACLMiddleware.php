<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;


class ACLMiddleware
{
    public function __construct(private UserRepository $userRepository)
    {
        // Constructor can be used to inject dependencies if needed
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = Route::currentRouteName();
        if(!$this->userRepository->hasPermission($request->user(), $routeName)) {
            return response()->json(['message' => 'Acesso Negado'], 403);
        }

        return $next($request);
    }
}
