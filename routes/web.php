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
    Route::post('/konten/artikel/tambah', [ArtikelControllerAdmin::class, 'store'])->name('admin.article.store');
    Route::get('/konten/artikel/edit/{articleId}', [ArtikelControllerAdmin::class, 'edit'])->name('admin.article.edit');
    Route::post('/konten/artikel/upload/{articleId}', [ArtikelControllerAdmin::class, 'update'])->name('admin.article.update');


    Route::get('/konten/foto', [FotoControllerAdmin::class, 'index'])->name('admin.photo.index');
    Route::get('/konten/foto/tambah', [FotoControllerAdmin::class, 'add'])->name('admin.photo.add');
    Route::post('/konten/foto/tambah', [FotoControllerAdmin::class, 'store'])->name('admin.photo.store');
    Route::get('/konten/foto/edit/{photoId}', [FotoControllerAdmin::class, 'edit'])->name('admin.photo.edit');
    Route::post('/konten/foto/update/{photoId}', [FotoControllerAdmin::class, 'update'])->name('admin.photo.update');

    Route::get('/konten/video', [VideoControllerAdmin::class, 'index'])->name('admin.video.index');
    Route::get('/konten/video/tambah', [VideoControllerAdmin::class, 'add'])->name('admin.video.add');
    Route::post('/konten/video/tambah', [VideoControllerAdmin::class, 'store'])->name('admin.video.store');
    Route::get('/konten/video/edit/{videoId}', [VideoControllerAdmin::class, 'edit'])->name('admin.video.edit');
    Route::post('/konten/video/update/{videoId}', [VideoControllerAdmin::class, 'update'])->name('admin.video.update');
    
    Route::get('/konten/publikasi', [PublikasiControllerAdmin::class, 'index'])->name('admin.publication.index');
    Route::get('/konten/publikasi/tambah', [PublikasiControllerAdmin::class, 'add'])->name('admin.publication.add');
    Route::post('/konten/publikasi/tambah', [PublikasiControllerAdmin::class, 'store'])->name('admin.publication.store');
    Route::get('/konten/publikasi/edit/{publicationId}', [PublikasiControllerAdmin::class, 'edit'])->name('admin.publication.edit');
    Route::post('/konten/publikasi/update/{publicationId}', [PublikasiControllerAdmin::class, 'update'])->name('admin.publication.update');
    
    Route::get('/konten/audio', [AudioControllerAdmin::class, 'index'])->name('admin.audio.index');
    Route::get('/konten/audio/tambah', [AudioControllerAdmin::class, 'add'])->name('admin.audio.add');
    Route::post('/konten/audio/tambah', [AudioControllerAdmin::class, 'store'])->name('admin.audio.store');
    Route::get('/konten/audio/edit/{audioId}', [AudioControllerAdmin::class, 'edit'])->name('admin.audio.edit');
    Route::post('/konten/audio/update/{audioId}', [AudioControllerAdmin::class, 'update'])->name('admin.audio.update');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/semua-artikel', [ArtikelController::class, 'index'])->name('articles');
Route::get('/semua-foto', [FotoController::class, 'index'])->name('photos');
Route::get('/semua-video', [VideoController::class, 'index'])->name('videos');
Route::get('/semua-audio', [AudioController::class, 'index'])->name('audios');
Route::get('/semua-publikasi', [PublikasiController::class, 'index'])->name('publications');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('article_detail');
Route::get('/artikel/{articleId}', [ArtikelController::class, 'show'])->name('article_detail');

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