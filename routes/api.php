<?php

use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => response()->json(['message' => 'Welcome to the API']));




Route::apiResource('/permissions', PermissionController::class);




Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('users.index');

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/