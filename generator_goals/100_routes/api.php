<?php

use App\Http\Controllers\Api\MasterController;
use App\Http\Controllers\Api\MasterDetailsController;
use Illuminate\Support\Facades\Route;

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('masters', MasterController::class);

        // Master Details
        Route::get('/masters/{master}/details', [MasterDetailsController::class, 'index'])
            ->name('masters.details.index');
        Route::post('/masters/{master}/details', [MasterDetailsController::class, 'store'])
            ->name('masters.details.store');
    });
