<?php

use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\DownloadController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;

Route::get('/', HomeController::class)->name('home');

Route::get('/noticias', [PostController::class, 'index'])->name('posts.index');
Route::get('/noticias/{post:post_slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/descargas', [DownloadController::class, 'index'])->name('downloads.index');

Route::get('/galeria', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('/galeria/{gallery:gal_slug}', [GalleryController::class, 'show'])->name('galleries.show');

Route::get('/contacto', [ContactController::class, 'index'])->name('contact');