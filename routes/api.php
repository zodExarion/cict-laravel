<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
// Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
//     Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
// });

Route::post('register', [AuthController::class, 'register']);
Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    // Route::post('register', [AuthController::class, 'register']);
    // Route::post('logout', [AuthController::class, 'logout']);
    // Route::post('refresh', [AuthController::class, 'refresh']);
    // Route::post('me', [AuthController::class, 'me']);
});
