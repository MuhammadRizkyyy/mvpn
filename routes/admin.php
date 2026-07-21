<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KegiatanController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [DashboardController::class, 'loginForm'])->name('login');
    Route::post('/login', [DashboardController::class, 'login'])->name('login.post');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('kegiatan', KegiatanController::class);
        Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
    });
});
