<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\Admin\PartnershipAdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGalleryController;

/*
|--------------------------------------------------------------------------
| SEO
|--------------------------------------------------------------------------
*/
Route::get('/robots.txt', [\App\Http\Controllers\SeoController::class, 'robots']);
Route::get('/sitemap.xml', [\App\Http\Controllers\SeoController::class, 'sitemap']);

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
| ARTIKEL (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/artikel', [\App\Http\Controllers\ArticleController::class, 'index'])
    ->name('artikel.index');
Route::get('/artikel/{artikel}', [\App\Http\Controllers\ArticleController::class, 'show'])
    ->name('artikel.show');

/*
|--------------------------------------------------------------------------
| PARTNERSHIP (USER)
|--------------------------------------------------------------------------
*/
Route::get('/partnership', [PartnershipController::class, 'create'])
    ->name('partnership.form');

Route::post('/partnership', [PartnershipController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('partnership.store');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->middleware('throttle:5,1');
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

    Route::delete('/partnerships/{id}', [PartnershipAdminController::class, 'destroy'])
        ->name('partnerships.destroy');

    // Program Kerja (Kegiatan)
    Route::post('/kegiatan/reorder', [\App\Http\Controllers\Admin\KegiatanController::class, 'reorder'])
        ->name('kegiatan.reorder');
    Route::resource('kegiatan', \App\Http\Controllers\Admin\KegiatanController::class)
        ->except(['show']);

    // Tentang
    Route::get('/tentang', [\App\Http\Controllers\Admin\AboutController::class, 'edit'])
        ->name('about.edit');
    Route::put('/tentang', [\App\Http\Controllers\Admin\AboutController::class, 'update'])
        ->name('about.update');

    // Visi & Misi
    Route::get('/visi-misi', [\App\Http\Controllers\Admin\VisiMisiController::class, 'edit'])
        ->name('visimisi.edit');
    Route::put('/visi-misi', [\App\Http\Controllers\Admin\VisiMisiController::class, 'update'])
        ->name('visimisi.update');
    Route::post('/misi', [\App\Http\Controllers\Admin\MisiItemController::class, 'store'])
        ->name('misi.store');
    Route::put('/misi/{misiItem}', [\App\Http\Controllers\Admin\MisiItemController::class, 'update'])
        ->name('misi.update');
    Route::delete('/misi/{misiItem}', [\App\Http\Controllers\Admin\MisiItemController::class, 'destroy'])
        ->name('misi.destroy');
    Route::post('/misi/reorder', [\App\Http\Controllers\Admin\MisiItemController::class, 'reorder'])
        ->name('misi.reorder');

    // Struktur Pengurus
    Route::post('/pengurus/reorder', [\App\Http\Controllers\Admin\PengurusController::class, 'reorder'])
        ->name('pengurus.reorder');
    Route::resource('pengurus', \App\Http\Controllers\Admin\PengurusController::class)
        ->parameters(['pengurus' => 'pengurus'])
        ->except(['show']);

    // Penanggung Jawab Kelas Bahasa
    Route::post('/language-coordinators/reorder', [\App\Http\Controllers\Admin\LanguageClassCoordinatorController::class, 'reorder'])
        ->name('language-coordinators.reorder');
    Route::resource('language-coordinators', \App\Http\Controllers\Admin\LanguageClassCoordinatorController::class)
        ->parameters(['language-coordinators' => 'languageCoordinator'])
        ->except(['show']);

    // Mitra
    Route::post('/mitra/reorder', [\App\Http\Controllers\Admin\MitraController::class, 'reorder'])
        ->name('mitra.reorder');
    Route::resource('mitra', \App\Http\Controllers\Admin\MitraController::class)
        ->except(['show']);

    // Artikel
    Route::post('/artikel/reorder', [\App\Http\Controllers\Admin\ArticleController::class, 'reorder'])
        ->name('artikel.reorder');
    Route::resource('artikel', \App\Http\Controllers\Admin\ArticleController::class)
        ->except(['show']);
});

Route::get('/galeri', [\App\Http\Controllers\GalleryController::class, 'index'])
    ->name('galeri.index');

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::post('/gallery/reorder', [AdminGalleryController::class, 'reorder'])
        ->name('gallery.reorder');
    Route::resource('gallery', AdminGalleryController::class)
        ->only(['index', 'store', 'update', 'destroy']);
});