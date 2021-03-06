<?php

use App\Models\User;
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

        Route::apiResource('roles', \App\Http\Controllers\V1\RoleController::class)->middleware('is-admin');

        Route::apiResource('user-roles', \App\Http\Controllers\V1\UserRoleController::class)->except(['destroy'])->middleware('is-admin');
        Route::delete('user-roles/unassign/{userId}/{roleId}', [\App\Http\Controllers\V1\UserRoleController::class, 'unassign'])->middleware('is-admin');

        Route::apiResource('gym-classes', \App\Http\Controllers\V1\GymClassController::class);

        Route::apiResource('gym-class-attendees', \App\Http\Controllers\V1\GymClassAttendeeController::class);

        Route::group(['prefix' => 'notifications'], function () {
            Route::get('unread', [\App\Http\Controllers\V1\NotificationController::class, 'unread']);
            Route::put('mark-all-as-read', [\App\Http\Controllers\V1\NotificationController::class, 'markAllAsRead']);
            Route::get('all', [\App\Http\Controllers\V1\NotificationController::class, 'all']);
            Route::put('{id}/mark-as-read', [\App\Http\Controllers\V1\NotificationController::class, 'markAsRead']);
            Route::delete('{id}/delete', [\App\Http\Controllers\V1\NotificationController::class, 'destroy']);
        });
    });
});
