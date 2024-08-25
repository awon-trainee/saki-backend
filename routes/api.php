<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Dashboard\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['throttle:20,3'])->group(function() {
    Route::post('login' , [LoginController::class , 'login']);
    Route::post('validate_otp' , [LoginController::class , 'validateOTP']);
});


Route::middleware(['throttle:100,5','auth:api'])->group(function() {
    Route::post('dashboard' , [DashboardController::class , 'dashboard']);
    Route::get('category/{category}' , [DashboardController::class , 'categoryProduct']);
    Route::get('market/{market}' , [DashboardController::class , 'MarketItems']);
    Route::post('purchase' , [DashboardController::class , 'purchase']);
    Route::get('purchase' , [DashboardController::class , 'purchaseDashboard']);
    Route::get('profile' , [DashboardController::class , 'profile']);
    Route::get('wallet' , [DashboardController::class , 'wallet']);
    Route::post('profile' , [DashboardController::class , 'updateProfile']);
    Route::post('logout' , [DashboardController::class , 'logout']);
    Route::post('delete' , [DashboardController::class , 'delete']);
});

// Route::get('/barcode/{text}', [DashboardController::class, 'barcode']);



