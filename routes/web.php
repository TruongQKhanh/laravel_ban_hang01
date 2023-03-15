<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Models\Category;
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


Route::get('/admin', [AdminController::class, 'loginAdmin']);
Route::post('/admin', [AdminController::class, 'postLoginAdmin']);

Route::get('/home', function () {
    return view('home');
});

Route::prefix('admin')->group(function () {
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    });
    
    Route::group(['prefix' => 'menus', 'as' => 'menus.'], function () {
        Route::get('', [MenuController::class, 'index'])->name('index');
        Route::get('create', [MenuController::class, 'create'])->name('create');
        Route::post('store', [MenuController::class, 'store'])->name('store');
        Route::get('edit/{id}', [MenuController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [MenuController::class, 'update'])->name('update');
        Route::get('delete/{id}', [MenuController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('', [AdminProductController::class, 'index'])->name('index');
    });
});
