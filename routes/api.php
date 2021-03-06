<?php

use App\Http\Controllers\API\Applicants\ApplicantApplicationActionController;
use App\Http\Controllers\API\Applicants\ApplicantIndexController;
use App\Http\Controllers\API\Applicants\ApplicantTotalController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\MeController;
use App\Http\Controllers\API\Jobs\JobDestroyController;
use App\Http\Controllers\API\Jobs\JobIndexController;
use App\Http\Controllers\API\Jobs\JobShowController;
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
    // api/jobs/{job:uuid}
    Route::get('{job:uuid}', JobShowController::class)->name('show');
    // api/jobs/{job:uuid}
    Route::delete('{job:uuid}', JobDestroyController::class)->name('delete');
});

/*
|--------------------------------------------------------------------------
| Applicants API Routes
|--------------------------------------------------------------------------
*/
Route::name('applicants.')->prefix('applicants')->group(function () {
    // api/applicants
    Route::get('/', ApplicantIndexController::class)->name('index');
    // api/applicants/total
    Route::get('total', ApplicantTotalController::class)->name('total');
    // api/applicants/{applicant:uuid}/action
    Route::post('{applicant:uuid}/action', ApplicantApplicationActionController::class)->name('action');
});
