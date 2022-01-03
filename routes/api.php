<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CheckInController;
use App\Http\Controllers\AuthenticationController;

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

// Register new user
Route::post(
    '/create-account',
    [AuthenticationController::class, 'createAccount']
);

// Login
Route::post('/login', [AuthenticationController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Get profile data
    Route::get('/profile', [AuthenticationController::class, 'getProfileData']);

    // Logout
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

// Check In routes
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'checkin', 'as' => 'api.checkin.'], function () {
    Route::post('create', [CheckInController::class, 'create'])->name('create');
    Route::get('view/{checkIn}', [CheckInController::class, 'view'])->name('view');
});
