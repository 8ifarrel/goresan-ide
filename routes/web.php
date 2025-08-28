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
use App\Http\Controllers\Guest\AuthGuestController;
use App\Http\Controllers\Guest\BlogKelolaGuestControler;
use App\Http\Controllers\Guest\ProfilGuestController;

Route:: as('guest.')->group(function () {
  Route::get('/', [BerandaGuestController::class, 'index'])
    ->name('beranda.index');

  Route::prefix('blog')->as('blog.')->group(function () {
    Route::get('/terkini', [BlogTerkiniGuestController::class, 'index'])
      ->name('terkini.index');
    Route::get('/populer', [BlogPopulerGuestController::class, 'index'])
      ->name('populer.index');

    Route::middleware('auth')->prefix('kelola')->as('kelola.')->group(function () {
      Route::get('/', [BlogKelolaGuestControler::class, 'index'])->name('index');
      Route::get('/buat', [BlogKelolaGuestControler::class, 'create'])->name('create');
      Route::post('/buat/kirim', [BlogKelolaGuestControler::class, 'store'])->name('store');
      Route::get('/edit/{blog}', [BlogKelolaGuestControler::class, 'edit'])->name('edit');
      Route::put('/edit/{blog}/kirim', [BlogKelolaGuestControler::class, 'update'])->name('update');
      Route::delete('hapus/{blog}', [BlogKelolaGuestControler::class, 'destroy'])->name('destroy');
    });

    Route::get('/{slug}', [BlogGuestController::class, 'show'])
      ->name('show');
  });

  // Auth routes
  Route::get('/login', [AuthGuestController::class, 'showLogin'])->name('login');
  Route::post('/login/kirim', [AuthGuestController::class, 'login']);
  Route::get('/register', [AuthGuestController::class, 'showRegister'])->name('register');
  Route::post('/register/kirim', [AuthGuestController::class, 'register']);
  Route::post('/logout', [AuthGuestController::class, 'logout'])->name('logout');

  Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfilGuestController::class, 'edit'])->name('profil.edit');
    Route::post('/profil', [ProfilGuestController::class, 'update'])->name('profil.update');
  });
});

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
|*/