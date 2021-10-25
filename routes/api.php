<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\MeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth API Routes
|--------------------------------------------------------------------------
*/
Route::name('auth.')->prefix('auth')->group(function () {
    // api/auth/login
    Route::post('login', LoginController::class)->name('login');
    // api/auth/logout
    Route::post('logout', LogoutController::class)->name('logout');
    // api/auth/me
    Route::get('me', MeController::class)->name('me');
});
