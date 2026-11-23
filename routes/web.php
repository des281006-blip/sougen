<?php

use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/layanan', [PageController::class, 'services'])->name('services');
Route::get('/galeri', [PageController::class, 'gallery'])->name('gallery');
Route::get('/berita', [PageController::class, 'newsIndex'])->name('news.index');
Route::get('/berita/{news:slug}', [PageController::class, 'newsShow'])->name('news.show');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

Route::get('/event', [EventController::class, 'index'])->name('events.index');
Route::get('/event/{event:slug}', [EventController::class, 'show'])->name('events.show');