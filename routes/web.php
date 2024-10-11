<?php

use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/login', [LoginController::class, 'login'])->name('login');
//Route::get('/login', [LogoutController::class, 'logout'])->name('logout');
