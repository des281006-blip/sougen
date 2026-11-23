<?php

use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\PageController;
use App\Http\Middleware\EnsureRole;
use Illuminate\Support\Facades\Route;

// ---------- Publik ----------
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/layanan', [PageController::class, 'services'])->name('services');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/berita', [PageController::class, 'newsIndex'])->name('news.index');
Route::get('/berita/{news:slug}', [PageController::class, 'newsShow'])->name('news.show');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

Route::get('/event', [EventController::class, 'index'])->name('events.index');
Route::get('/event/{event:slug}', [EventController::class, 'show'])->name('events.show');

// ---------- Autentikasi ----------
Route::middleware('guest')->group(function () {
    Route::get('/masuk', [LoginController::class, 'create'])->name('login');
    Route::post('/masuk', [LoginController::class, 'store'])->middleware('throttle:6,1');
    Route::get('/daftar', [RegisterController::class, 'create'])->name('register');
    Route::post('/daftar', [RegisterController::class, 'store'])->middleware('throttle:6,1');
});

Route::post('/keluar', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

// ---------- Admin / Panitia ----------
Route::middleware(['auth', EnsureRole::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profil', [CompanyProfileController::class, 'edit'])->name('company.edit');
        Route::put('/profil', [CompanyProfileController::class, 'update'])->name('company.update');
    });