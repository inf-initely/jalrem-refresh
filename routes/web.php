<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Admin\ArtikelController as ArtikelControllerAdmin;
use App\Http\Controllers\Admin\FotoController as FotoControllerAdmin;
use App\Http\Controllers\Admin\VideoController as VideoControllerAdmin;
use App\Http\Controllers\Admin\PublikasiController as PublikasiControllerAdmin;
use App\Http\Controllers\Admin\AudioController as AudioControllerAdmin;

use App\Http\Controllers\Admin\RempahController as RempahControllerAdmin;
use App\Http\Controllers\Admin\KontributorController as KontributorControllerAdmin;

use App\Http\Controllers\Admin\KerjasamaController as KerjasamaControllerAdmin;
use App\Http\Controllers\Admin\KegiatanController as KegiatanControllerAdmin;

use App\Http\Controllers\Admin\UserController as UserControllerAdmin;
use App\Http\Controllers\Admin\KontributorArtikelController as KontributorArtikelControllerAdmin;

use App\Http\Controllers\Admin\SettingController as SettingControllerAdmin;

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
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\RempahController;
use App\Http\Controllers\KontributorController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\RedirectController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaptchaServiceController;

// use App\Http\Middleware\Language;
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
Route::any('en/{allsegments}', function($first, $rest = '') {
    Session::put('lg', 'en');
    return redirect("{$first}/{$rest}");
})->where('allsegments','(.*)?');

Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function() {
    Route::get('/', [HomeControllerAdmin::class, 'index'])->name('admin.home');

    Route::get('/konten/artikel', [ArtikelControllerAdmin::class, 'index'])->name('admin.article.index');
    Route::get('/konten/artikel/tambah', [ArtikelControllerAdmin::class, 'add'])->name('admin.article.add');
    Route::post('/konten/artikel/tambah', [ArtikelControllerAdmin::class, 'store'])->name('admin.article.store');
    Route::get('/konten/artikel/edit/{articleId}', [ArtikelControllerAdmin::class, 'edit'])->name('admin.article.edit');
    Route::post('/konten/artikel/upload/{articleId}', [ArtikelControllerAdmin::class, 'update'])->name('admin.article.update');
    Route::get('/konten/artikel/delete/{articleId}', [ArtikelControllerAdmin::class, 'delete'])->name('admin.article.delete');

    Route::get('/konten/foto', [FotoControllerAdmin::class, 'index'])->name('admin.photo.index');
    Route::get('/konten/foto/tambah', [FotoControllerAdmin::class, 'add'])->name('admin.photo.add');
    Route::post('/konten/foto/tambah', [FotoControllerAdmin::class, 'store'])->name('admin.photo.store');
    Route::get('/konten/foto/edit/{photoId}', [FotoControllerAdmin::class, 'edit'])->name('admin.photo.edit');
    Route::post('/konten/foto/update/{photoId}', [FotoControllerAdmin::class, 'update'])->name('admin.photo.update');
    Route::get('/konten/foto/delete/{photoId}', [FotoControllerAdmin::class, 'delete'])->name('admin.photo.delete');

    Route::get('/konten/video', [VideoControllerAdmin::class, 'index'])->name('admin.video.index');
    Route::get('/konten/video/tambah', [VideoControllerAdmin::class, 'add'])->name('admin.video.add');
    Route::post('/konten/video/tambah', [VideoControllerAdmin::class, 'store'])->name('admin.video.store');
    Route::get('/konten/video/edit/{videoId}', [VideoControllerAdmin::class, 'edit'])->name('admin.video.edit');
    Route::post('/konten/video/update/{videoId}', [VideoControllerAdmin::class, 'update'])->name('admin.video.update');
    Route::get('/konten/video/delete/{videoId}', [VideoControllerAdmin::class, 'delete'])->name('admin.video.delete');

    Route::get('/konten/publikasi', [PublikasiControllerAdmin::class, 'index'])->name('admin.publication.index');
    Route::get('/konten/publikasi/tambah', [PublikasiControllerAdmin::class, 'add'])->name('admin.publication.add');
    Route::post('/konten/publikasi/tambah', [PublikasiControllerAdmin::class, 'store'])->name('admin.publication.store');
    Route::get('/konten/publikasi/edit/{publicationId}', [PublikasiControllerAdmin::class, 'edit'])->name('admin.publication.edit');
    Route::post('/konten/publikasi/update/{publicationId}', [PublikasiControllerAdmin::class, 'update'])->name('admin.publication.update');
    Route::get('/konten/publikasi/delete/{publicationId}', [PublikasiControllerAdmin::class, 'delete'])->name('admin.publication.delete');

    Route::get('/konten/audio', [AudioControllerAdmin::class, 'index'])->name('admin.audio.index');
    Route::get('/konten/audio/tambah', [AudioControllerAdmin::class, 'add'])->name('admin.audio.add');
    Route::post('/konten/audio/tambah', [AudioControllerAdmin::class, 'store'])->name('admin.audio.store');
    Route::get('/konten/audio/edit/{audioId}', [AudioControllerAdmin::class, 'edit'])->name('admin.audio.edit');
    Route::post('/konten/audio/update/{audioId}', [AudioControllerAdmin::class, 'update'])->name('admin.audio.update');
    Route::get('/konten/audio/delete/{audioId}', [AudioControllerAdmin::class, 'delete'])->name('admin.audio.delete');


    // MASTER DATA
    Route::get('/master/rempah', [RempahControllerAdmin::class, 'index'])->name('admin.rempah.index');
    Route::get('/master/rempah/tambah', [RempahControllerAdmin::class, 'add'])->name('admin.rempah.add');
    Route::post('/master/rempah/tambah', [RempahControllerAdmin::class, 'store'])->name('admin.rempah.store');
    Route::get('/master/rempah/edit/{rempahId}', [RempahControllerAdmin::class, 'edit'])->name('admin.rempah.edit');
    Route::post('/master/rempah/update/{rempahId}', [RempahControllerAdmin::class, 'update'])->name('admin.rempah.update');
    Route::get('/master/rempah/delete/{rempahId}', [RempahControllerAdmin::class, 'delete'])->name('admin.rempah.delete');

    Route::get('/master/kontributor', [KontributorControllerAdmin::class, 'index'])->name('admin.contributor.index');
    Route::get('/master/kontributor/tambah', [KontributorControllerAdmin::class, 'add'])->name('admin.contributor.add');
    Route::post('/master/kontributor/tambah', [KontributorControllerAdmin::class, 'store'])->name('admin.contributor.store');
    Route::get('/master/kontributor/edit/{contributorId}', [KontributorControllerAdmin::class, 'edit'])->name('admin.contributor.edit');
    Route::post('/master/kontributor/update/{contributorId}', [KontributorControllerAdmin::class, 'update'])->name('admin.contributor.update');
    Route::get('/master/kontributor/delete/{contributorId}', [KontributorControllerAdmin::class, 'delete'])->name('admin.contributor.delete');

    // INFORMASI
    Route::get('/informasi/kerjasama', [KerjasamaControllerAdmin::class, 'index'])->name('admin.kerjasama.index');
    Route::get('/informasi/kerjasama/tambah', [KerjasamaControllerAdmin::class, 'add'])->name('admin.kerjasama.add');
    Route::post('/informasi/kerjasama/tambah', [KerjasamaControllerAdmin::class, 'store'])->name('admin.kerjasama.store');
    Route::get('/informasi/kerjasama/edit/{kerjasamaId}', [KerjasamaControllerAdmin::class, 'edit'])->name('admin.kerjasama.edit');
    Route::post('/informasi/kerjasama/update/{kerjasamaId}', [KerjasamaControllerAdmin::class, 'update'])->name('admin.kerjasama.update');
    Route::get('/informasi/kerjasama/delete/{kerjasamaId}', [KerjasamaControllerAdmin::class, 'delete'])->name('admin.kerjasama.delete');

    Route::get('/informasi/kegiatan', [KegiatanControllerAdmin::class, 'index'])->name('admin.kegiatan.index');
    Route::get('/informasi/kegiatan/tambah', [KegiatanControllerAdmin::class, 'add'])->name('admin.kegiatan.add');
    Route::post('/informasi/kegiatan/tambah', [KegiatanControllerAdmin::class, 'store'])->name('admin.kegiatan.store');
    Route::get('/informasi/kegiatan/edit/{kerjasamaId}', [KegiatanControllerAdmin::class, 'edit'])->name('admin.kegiatan.edit');
    Route::post('/informasi/kegiatan/update/{kerjasamaId}', [KegiatanControllerAdmin::class, 'update'])->name('admin.kegiatan.update');
    Route::get('/informasi/kegiatan/delete/{kerjasamaId}', [KegiatanControllerAdmin::class, 'delete'])->name('admin.kegiatan.delete');

    Route::get('/artikel-kontributor', [KontributorArtikelControllerAdmin::class, 'index'])->name('admin.contributor_article.index');
    
    Route::group(['middleware' => 'superadmin', 'prefix' => '/user'], function() {
        Route::get('/', [UserControllerAdmin::class, 'index'])->name('admin.user.index');
        Route::get('/tambah', [UserControllerAdmin::class, 'add'])->name('admin.user.add');
        Route::post('/tambah', [UserControllerAdmin::class, 'store'])->name('admin.user.store');
        Route::get('/edit/{id}', [UserControllerAdmin::class, 'edit'])->name('admin.user.edit');
        Route::post('/update/{id}', [UserControllerAdmin::class, 'update'])->name('admin.user.update');
        Route::get('/action/{id}', [UserControllerAdmin::class, 'action'])->name('admin.user.action');
    });

    Route::get('/pengaturan', [SettingControllerAdmin::class, 'index'])->name('admin.setting.index');
    Route::post('/pengaturan', [SettingControllerAdmin::class, 'update'])->name('admin.setting.update');
});

Route::get('/kontributor', [KontributorController::class, 'index'])->name('contributor');
Route::post('/kontributor/artikel/upload', [KontributorController::class, 'upload'])->name('article_upload_contributor');


// Route::middleware(['language'])->group(function() {
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/semua-artikel', [ArtikelController::class, 'index'])->name('articles');
Route::get('/semua-foto', [FotoController::class, 'index'])->name('photos');
Route::get('/semua-video', [VideoController::class, 'index'])->name('videos');
Route::get('/semua-audio', [AudioController::class, 'index'])->name('audios');
Route::get('/semua-publikasi', [PublikasiController::class, 'index'])->name('publications');
Route::get('/semua-kegiatan', [KegiatanController::class, 'index'])->name('events');

Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('article_detail');
Route::get('/foto/{slug}', [FotoController::class, 'show'])->name('photo_detail');
Route::get('/video/{slug}', [VideoController::class, 'show'])->name('video_detail');
Route::get('/audio/{slug}', [AudioController::class, 'show'])->name('audio_detail');
Route::get('/publikasi/{slug}', [PublikasiController::class, 'show'])->name('publication_detail');
Route::get('/kegiatan/{slug}', [KegiatanController::class, 'show'])->name('event_detail');
Route::get('/kerjasama/{slug}', [KerjasamaController::class, 'show'])->name('kerjasama_detail');

Route::get('/cari', [SearchController::class, 'search'])->name('article_search');

Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');
Route::get('/semua-kerjasama', [KerjasamaController::class, 'index'])->name('kerjasama');
Route::get('/semua-kegiatan', [KegiatanController::class, 'index'])->name('events');
Route::get('/konten', [KontenController::class, 'index'])->name('konten');
Route::get('/tentang-jalur', [JalurController::class, 'index'])->name('tentangjalur');
Route::get('/tentang-jejak', [JejakController::class, 'index'])->name('tentangjejak');
Route::get('/tentang-masa-depan', [MasaDepanController::class, 'index'])->name('tentangmasadepan');
Route::get('/funfact/{rempahName}', [RempahController::class, 'show'])->name('rempah_detail');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_post'])->name('login_post');
// Route::get('/register', [AuthController::class, 'register'])->name('register');
// Route::post('/register', [AuthController::class, 'register_post'])->name('register_post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// });

// RELOAD CAPTCHA
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);

Route::get('/set_language/en', function() {
    Session::put('lg', 'en');
    return redirect()->back();
})->name('set_language_en');

Route::get('/set_language/id', function() {
    Session::forget('lg');
    return redirect()->back();
})->name('set_language_id');

// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });


// JSON
Route::get('get_rempah_json', [RempahController::class, 'getJSON'])->name('get_rempah_json');
Route::get('get_location_json', [LokasiController::class, 'getJSON'])->name('get_location_json');

// route for test sentry on prods
Route::get('/debug-sentry', function () {
    if (! app()->environment('production')) throw new Exception('Test Sentry error!');
});

Route::get('/{slug}', [RedirectController::class, 'index']);
