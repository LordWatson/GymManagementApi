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

// This is the simplest way I can think of to separate API Route Versions
// There is another way involving the RouteServiceProvider and mapping API routes with Middleware
require __DIR__.'/api_v1.php';
require __DIR__.'/api_v2.php';
