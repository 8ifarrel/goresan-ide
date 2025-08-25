<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Web Routes
|--------------------------------------------------------------------------
| 
|*/

use App\Http\Controllers\Guest\BerandaGuestController;
use App\Http\Controllers\Guest\BlogTerkiniGuestController;
use App\Http\Controllers\Guest\BlogPopulerGuestController;
use App\Http\Controllers\Guest\BlogGuestController;

Route::as('guest.')->group(function () {
  Route::get('/', [BerandaGuestController::class, 'index'])
    ->name('beranda.index');

  Route::prefix('blog')->as('blog.')->group(function () {
    Route::get('/terkini', [BlogTerkiniGuestController::class, 'index'])
      ->name('terkini.index');
    Route::get('/populer', [BlogPopulerGuestController::class, 'index'])
      ->name('populer.index');
    Route::get('/ini-judul', [BlogGuestController::class, 'show'])
      ->name('show');
  });
});

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
|*/