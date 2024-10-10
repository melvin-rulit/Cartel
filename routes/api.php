<?php

use App\Http\Controllers\V1\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
//Route::post('/auth/logout', [\App\app\Http\Controllers\V1\Api\Auth\AuthController::class, 'logout']);
//Route::post('/auth/register', [\App\app\Http\Controllers\V1\Api\Auth\AuthController::class, 'register']);
Route::post('/auth/check-sms', [AuthController::class, 'checkSms']);
//Route::delete('/tokens/{tokenId}', [\App\app\Http\Controllers\V1\Api\Auth\AuthController::class, 'destroyToken']);
