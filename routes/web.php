<?php

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PostController;
use App\Http\Controllers\Public\DownloadController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\ContactController;

Route::get('/', [HomeController::class, 'index'])->name('public.home');

Route::get('/noticias', [PostController::class, 'index'])->name('public.posts.index');
Route::get('/noticias/{post:post_slug}', [PostController::class, 'show'])->name('public.posts.show');

Route::get('/descargas', [DownloadController::class, 'index'])->name('public.downloads.index');

Route::get('/galeria', [GalleryController::class, 'index'])->name('public.galleries.index');
Route::get('/galeria/{gallery:gal_slug}', [GalleryController::class, 'show'])->name('public.galleries.show');

Route::get('/contacto', [ContactController::class, 'index'])->name('public.contact.index');