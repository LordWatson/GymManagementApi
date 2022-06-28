<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1'], function () {
    Route::post('/register', [\App\Http\Controllers\V1\ApiAuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\V1\ApiAuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout',[\App\Http\Controllers\V1\ApiAuthController::class, 'logout']);

        Route::apiResource('users', \App\Http\Controllers\V1\UserController::class);
    });
});
