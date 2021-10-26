<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('{job:uuid}', [HomeController::class, 'show'])->name('show');
Route::get('{job:uuid}/apply', [JobApplicationController::class, 'show'])->name('apply');
Route::post('{job:uuid}/apply', [JobApplicationController::class, 'store']);
