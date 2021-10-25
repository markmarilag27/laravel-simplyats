<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\MeController;
use App\Http\Controllers\API\Jobs\JobIndexController;
use App\Http\Controllers\API\Jobs\JobStoreController;
use App\Http\Controllers\API\Jobs\JobUpdateController;
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

/*
|--------------------------------------------------------------------------
| Jobs API Routes
|--------------------------------------------------------------------------
*/
Route::name('jobs.')->prefix('jobs')->group(function () {
    // api/jobs
    Route::get('/', JobIndexController::class)->name('index');
    // api/jobs
    Route::post('/', JobStoreController::class)->name('store');
    // api/jobs/{job:uuid}
    Route::put('{job:uuid}', JobUpdateController::class)->name('update');
});
