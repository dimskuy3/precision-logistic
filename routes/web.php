<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PolDataController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('dashboard'));

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pol', [PolDataController::class, 'index'])->name('pol.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/pol/create', [PolDataController::class, 'create'])->name('pol.create');
        Route::post('/pol', [PolDataController::class, 'store'])->name('pol.store');
        Route::get('/pol/{pol}/edit', [PolDataController::class, 'edit'])->name('pol.edit');
        Route::put('/pol/{pol}', [PolDataController::class, 'update'])->name('pol.update');
        Route::delete('/pol/{pol}', [PolDataController::class, 'destroy'])->name('pol.destroy');

        Route::get('/upload', [UploadController::class, 'index'])->name('upload.index');
        Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
    });
});
