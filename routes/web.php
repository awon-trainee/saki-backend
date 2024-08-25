<?php

use App\Http\Controllers\Api\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('healthy' , function() {
    return 200;
});

Route::redirect('/', config('backpack.base.route_prefix'));
Route::get('/barcode/{text}', [DashboardController::class, 'barcode']);