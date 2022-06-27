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

Route::group(['prefix' => 'v2'], function () {
    Route::post('/register', [\App\Http\Controllers\Api\V1\ApiAuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\Api\V1\ApiAuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout',[\App\Http\Controllers\Api\V1\ApiAuthController::class, 'logout']);

        Route::resource('classes', \App\Http\Controllers\Api\V1\ClassesController::class);
        Route::resource('roles', \App\Http\Controllers\Api\V1\RoleController::class);

        Route::group(['prefix' => 'notifications'], function () {
            Route::get('unread', [\App\Http\Controllers\Api\V1\NotificationController::class, 'unread']);
            Route::get('all', [\App\Http\Controllers\Api\V1\NotificationController::class, 'all']);
            Route::put('{id}/markAsRead', [\App\Http\Controllers\Api\V1\NotificationController::class, 'markAsRead']);
            Route::delete('{id}/delete', [\App\Http\Controllers\Api\V1\NotificationController::class, 'destroy']);
        });
    });
});
