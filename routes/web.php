<?php

use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function() {
    Route::prefix('customer')->name('customer.')->group(function() {
        Route::get('/', [PelangganController::class, 'index'])->name('index');
        Route::get('/add', [PelangganController::class, 'create'])->name('add');
        Route::post('/add-process', [PelangganController::class, 'processCreate'])->name('add-process');
        Route::get('/edit/{id?}', [PelangganController::class, 'update'])->name('edit');
        Route::post('/edit-process', [PelangganController::class, 'processUpdate'])->name('edit-process');
        Route::get('/delete/{id?}', [PelangganController::class, 'delete'])->name('delete');
    });
    Route::prefix('product')->name('product.')->group(function() {
        Route::get('/', [ProdukController::class, 'index'])->name('index');
        Route::get('/add', [ProdukController::class, 'create'])->name('add');
        Route::post('/add-process', [ProdukController::class, 'processCreate'])->name('add-process');
        Route::get('/edit/{id?}', [ProdukController::class, 'update'])->name('edit');
        Route::post('/edit-process', [ProdukController::class, 'processUpdate'])->name('edit-process');
        Route::get('/delete/{id?}', [ProdukController::class, 'delete'])->name('delete');
    });
    Route::prefix('user')->name('user.')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/add', [UserController::class, 'create'])->name('add');
        Route::post('/add-process', [UserController::class, 'processCreate'])->name('add-process');
        Route::get('/edit/{id?}', [UserController::class, 'update'])->name('edit');
        Route::post('/edit-process', [UserController::class, 'processUpdate'])->name('edit-process');
        Route::get('/delete/{id?}', [UserController::class, 'delete'])->name('delete');
    });
    Route::prefix('sales')->name('sales.')->group(function() {
        Route::get('/', [PenjualanController::class, 'index'])->name('index');
        Route::get('/add', [PenjualanController::class, 'create'])->name('add');
        Route::post('/add-process', [PenjualanController::class, 'processCreate'])->name('add-process');
        Route::post('/add-item', [PenjualanController::class, 'addSalesItem'])->name('add-item');
        Route::get('/detail/{id?}', [PenjualanController::class, 'detailSales'])->name('detail');
        Route::get('/delete/{id?}', [PenjualanController::class, 'delete'])->name('delete');
        Route::get('/delete-item/{id?}', [PenjualanController::class, 'deleteSalesItem'])->name('delete-item');
    });
});