<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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
Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('menu', [UserController::class, 'menu'])->name('menu');
Route::get('cart', [UserController::class, 'cart'])->name('cart');
Route::get('infoProduct/{id}', [UserController::class, 'infoProduct'])->name('infoProduct');
Route::get('totalPriceCart', [UserController::class, 'totalPriceCart'])->name('totalPriceCart');

Route::post('validateLogin', [AuthController::class, 'validateLogin'])->name('validateLogin');
Route::post ('userDetails', [UserController::class, 'userDetails'])->name('userDetails');
Route::post('addToCart/{id}', [UserController::class, 'addToCart'])->name('addRemoveToCart');
Route::post('updateQuantity/{id}', [UserController::class, 'updateQuantity'])->name('updateQuantity');

Route::group(['middleware' => ['customAuth']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('addProduct', [AdminController::class, 'addProductView'])->name('addProduct');
    Route::get('viewProducts', [AdminController::class, 'viewProducts'])->name('viewProducts');
    Route::get('detailsProduct/{id}', [AdminController::class, 'detailsProduct'])->name('detailsProduct');
    Route::get('updateProductView/{id}', [AdminController::class, 'updateProductView'])->name('updateProductView');
    Route::get('adminProfile', [AdminController::class, 'adminProfile'])->name('adminProfile');

    Route::post('addProductDataBase', [AdminController::class, 'addProductDataBase'])->name('addProductDataBase');
    Route::post('logout', [AdminController::class, 'logout'])->name('logout');
    Route::post('deleteProduct/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');

    Route::patch('updateProduct/{id}', [AdminController::class, 'updateProduct'])->name('updateProduct');
});
