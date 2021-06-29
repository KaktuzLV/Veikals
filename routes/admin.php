<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ManufacturersController;
use App\Http\Controllers\Admin\ColorsController;
use App\Http\Controllers\Admin\SizesController;
use App\Http\Controllers\Admin\ProductsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function() {
    Route::middleware(['auth', 'role:admin,support'])->group(function() {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    Route::middleware(['auth', 'role:admin'])->group(function() {
        Route::resource('categories', CategoriesController::class)->except([
            'show'
        ]);
        Route::resource('users',UsersController::class)->except([
            'show', 'create', 'store'
        ]);
        Route::resource('manufacturers',ManufacturersController::class)->except([
            'show'
        ]);
        Route::resource('sizes',SizesController::class)->except([
            'show'
        ]);
        Route::resource('colors',ColorsController::class)->except([
            'show'
        ]);
        Route::resource('products',ProductsController::class)->except([
            'show'
        ]);
    });
});
