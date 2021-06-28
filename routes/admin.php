<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\UsersController;
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
    });
});
