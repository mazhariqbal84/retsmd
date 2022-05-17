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
use App\Http\Controllers\Auth\AuthController;

Route::middleware('cors')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('forget-password', [AuthController::class, 'forget_password']);
        Route::post('otp-verify', [AuthController::class, 'otp_verify']);
        Route::post('password-change', [AuthController::class, 'password_change']);
        Route::post('resend-otp-code', [AuthController::class, 'resend_otp_code']);
    });


Route::middleware('auth:sanctum')->group( function () {
    Route::prefix('auth')->group(function () {

        Route::get('/user', [AuthController::class, 'user']);
        Route::get('/refresh', [AuthController::class, 'refresh']);

        // User Logout
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
});
