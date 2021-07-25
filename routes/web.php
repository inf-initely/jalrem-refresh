<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\FotoController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\PublikasiController;
use App\Http\Controllers\Admin\SuaraController;

use App\Http\Controllers\Admin\HomeController as HomeControllerAdmin;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function() {
    Route::get('/', [HomeControllerAdmin::class, 'index'])->name('admin.home');

    Route::get('/konten/artikel', [ArtikelController::class, 'index'])->name('admin.article.index');
    Route::get('/konten/artikel/tambah', [ArtikelController::class, 'add'])->name('admin.article.add');
    Route::get('/konten/artikel/edit', [ArtikelController::class, 'edit'])->name('admin.article.edit');


    Route::get('/konten/foto', [FotoController::class, 'index'])->name('admin.photo.index');
    Route::get('/konten/foto/tambah', [FotoController::class, 'add'])->name('admin.photo.add');
    Route::get('/konten/foto/edit', [FotoController::class, 'edit'])->name('admin.photo.edit');

    Route::get('/konten/video', [VideoController::class, 'index'])->name('admin.video.index');
    Route::get('/konten/video/tambah', [VideoController::class, 'add'])->name('admin.video.add');
    Route::get('/konten/video/edit', [VideoController::class, 'edit'])->name('admin.video.edit');
    
    Route::get('/konten/publikasi', [PublikasiController::class, 'index'])->name('admin.publication.index');
    Route::get('/konten/publikasi/tambah', [PublikasiController::class, 'add'])->name('admin.publication.add');
    Route::get('/konten/publikasi/edit', [PublikasiController::class, 'edit'])->name('admin.publication.edit');
    
    Route::get('/konten/suara', [SuaraController::class, 'index'])->name('admin.sound.index');
    Route::get('/konten/suara/tambah', [SuaraController::class, 'add'])->name('admin.sound.add');
    Route::get('/konten/suara/edit', [SuaraController::class, 'edit'])->name('admin.sound.edit');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/semua-artikel', [])
