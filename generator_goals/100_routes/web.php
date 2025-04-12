<?php

use App\Http\Controllers\MasterController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('masters', MasterController::class);
    });
