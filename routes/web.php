<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CustomAuth;
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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('validateLogin', [AuthController::class, 'validateLogin'])->name('validateLogin');

Route::group(['middleware' => ['customAuth']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('addProduct', [AdminController::class, 'addProduct'])->name('addProduct');
    Route::post('logout', [AdminController::class, 'logout'])->name('logout');
});
