<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/noticias', 'posts.index')->name('posts.index');
Route::view('/descargas', 'downloads.index')->name('downloads.index');
Route::view('/galeria', 'galleries.index')->name('galleries.index');
Route::view('/contacto', 'contact')->name('contact');