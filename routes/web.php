<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ArtikelController as ArtikelControllerAdmin;
use App\Http\Controllers\Admin\FotoController as FotoControllerAdmin;
use App\Http\Controllers\Admin\VideoController as VideoControllerAdmin;
use App\Http\Controllers\Admin\PublikasiController as PublikasiControllerAdmin;
use App\Http\Controllers\Admin\AudioController as AudioControllerAdmin;

use App\Http\Controllers\Admin\HomeController as HomeControllerAdmin;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\JalurController;
use App\Http\Controllers\JejakController;
use App\Http\Controllers\MasaDepanController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\KegiatanController;

use App\Http\Controllers\AuthController;
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

Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function() {
    Route::get('/', [HomeControllerAdmin::class, 'index'])->name('admin.home');

    Route::get('/konten/artikel', [ArtikelControllerAdmin::class, 'index'])->name('admin.article.index');
    Route::get('/konten/artikel/tambah', [ArtikelControllerAdmin::class, 'add'])->name('admin.article.add');
    Route::get('/konten/artikel/edit', [ArtikelControllerAdmin::class, 'edit'])->name('admin.article.edit');


    Route::get('/konten/foto', [FotoControllerAdmin::class, 'index'])->name('admin.photo.index');
    Route::get('/konten/foto/tambah', [FotoControllerAdmin::class, 'add'])->name('admin.photo.add');
    Route::get('/konten/foto/edit', [FotoControllerAdmin::class, 'edit'])->name('admin.photo.edit');

    Route::get('/konten/video', [VideoControllerAdmin::class, 'index'])->name('admin.video.index');
    Route::get('/konten/video/tambah', [VideoControllerAdmin::class, 'add'])->name('admin.video.add');
    Route::get('/konten/video/edit', [VideoControllerAdmin::class, 'edit'])->name('admin.video.edit');
    
    Route::get('/konten/publikasi', [PublikasiControllerAdmin::class, 'index'])->name('admin.publication.index');
    Route::get('/konten/publikasi/tambah', [PublikasiControllerAdmin::class, 'add'])->name('admin.publication.add');
    Route::get('/konten/publikasi/edit', [PublikasiControllerAdmin::class, 'edit'])->name('admin.publication.edit');
    
    Route::get('/konten/suara', [SuaraControllerAdmin::class, 'index'])->name('admin.sound.index');
    Route::get('/konten/suara/tambah', [SuaraControllerAdmin::class, 'add'])->name('admin.sound.add');
    Route::get('/konten/suara/edit', [SuaraControllerAdmin::class, 'edit'])->name('admin.sound.edit');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/semua-artikel', [ArtikelController::class, 'index'])->name('articles');
Route::get('/semua-foto', [FotoController::class, 'index'])->name('photos');
Route::get('/semua-video', [VideoController::class, 'index'])->name('videos');
Route::get('/semua-audio', [AudioController::class, 'index'])->name('audios');
Route::get('/semua-publikasi', [PublikasiController::class, 'index'])->name('publications');

Route::get('/artikel', [ArtikelController::class, 'show'])->name('article_detail');
Route::get('/kegiatan', [KegiatanController::class, 'show'])->name('event_detail');
Route::get('/foto', [FotoController::class, 'show'])->name('photo_detail');

Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');
Route::get('/konten', [KontenController::class, 'index'])->name('konten');
Route::get('/tentang-jalur', [JalurController::class, 'index'])->name('tentangjalur');
Route::get('/tentang-jejak', [JejakController::class, 'index'])->name('tentangjejak');
Route::get('/tentang-masa-depan', [MasaDepanController::class, 'index'])->name('tentangmasadepan');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_post'])->name('login_post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_post'])->name('register_post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');