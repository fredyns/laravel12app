<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// status
Route::any('/', [AuthController::class, 'status'])->name('api.status');

// login
Route::post('login', [AuthController::class, 'login'])->name('api.login');

// registration
Route::post('registration', [AuthController::class, 'registration'])->name(
    'api.registration'
);

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        // current user
        Route::get('user', fn(Request $req) => ['data' => $req->user()])->name('user');

        // logout
        Route::post('logout', [AuthController::class, 'logout'])->name(
            'logout'
        );
    });
