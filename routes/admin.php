<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin,support'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {

});
