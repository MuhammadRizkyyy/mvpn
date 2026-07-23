<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\Admin\PartnershipAdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\AdminGalleryController;

/*
|--------------------------------------------------------------------------
| LANGUAGE SWITCH
|--------------------------------------------------------------------------
*/
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en', 'fr', 'es'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('lang.switch');

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/
Route::view('/', 'pages.index1')->name('index1');

// Halaman-halaman lama sekarang jadi section di satu halaman (scroll, bukan pindah halaman)
Route::redirect('/tentang', '/#tentang')->name('tentang');
Route::redirect('/visimisi', '/#visimisi')->name('visimisi');
Route::redirect('/struktur', '/#struktur')->name('struktur');
Route::redirect('/proker', '/#proker')->name('proker');
Route::redirect('/dokumentasi', '/#dokumentasi')->name('dokumentasi');
Route::redirect('/mitra', '/#mitra')->name('kemitraan');
Route::redirect('/kerjasama', '/#kerjasama')->name('kerjasama');

/*
|--------------------------------------------------------------------------
| PARTNERSHIP (USER)
|--------------------------------------------------------------------------
*/
Route::get('/partnership', [PartnershipController::class, 'create'])
    ->name('partnership.form');

Route::post('/partnership', [PartnershipController::class, 'store'])
    ->name('partnership.store');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN AREA (PROTECTED)
|--------------------------------------------------------------------------
*/
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    // Partnership Management
    Route::get('/partnerships', [PartnershipAdminController::class, 'index'])
        ->name('partnerships.index');

    Route::get('/partnerships/{id}', [PartnershipAdminController::class, 'show'])
        ->name('partnerships.show');

    Route::post('/partnerships/{id}/approve', [PartnershipAdminController::class, 'approve'])
        ->name('partnerships.approve');

    Route::post('/partnerships/{id}/reject', [PartnershipAdminController::class, 'reject'])
        ->name('partnerships.reject');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/gallery', [GalleryController::class, 'index'])->name('admin.gallery');
    Route::post('/gallery', [GalleryController::class, 'store']);
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy']);
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/gallery', [AdminGalleryController::class, 'index']);
    Route::post('/gallery', [AdminGalleryController::class, 'store']);
    Route::delete('/gallery/{id}', [AdminGalleryController::class, 'destroy']);
});


Route::get('/galeri', [GalleryController::class, 'index']);
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::resource('gallery', AdminGalleryController::class)
        ->only(['index', 'store', 'destroy']);
});