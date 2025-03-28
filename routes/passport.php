<?php

use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizationController;
use Laravel\Passport\Http\Controllers\ClientController;
use Laravel\Passport\Http\Controllers\PersonalAccessTokenController;
use Laravel\Passport\Http\Controllers\ScopeController;
use Illuminate\Support\Facades\Route;

Route::prefix('oauth')->group(function () {
    Route::post('/token', [AccessTokenController::class, 'issueToken'])
        ->middleware(['throttle']);

    Route::get('/authorize', [AuthorizationController::class, 'authorize']);
    Route::post('/token/refresh', [AccessTokenController::class, 'issueToken']);
    Route::post('/clients', [ClientController::class, 'store']);
    Route::get('/clients', [ClientController::class, 'forUser']);
    Route::delete('/clients/{client_id}', [ClientController::class, 'destroy']);
    Route::get('/scopes', [ScopeController::class, 'all']);
    Route::get('/personal-access-tokens', [PersonalAccessTokenController::class, 'forUser']);
});
