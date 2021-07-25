<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ArtikelController;

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
    Route::get('/', [ArtikelController::class, 'index']);

    Route::get('/konten/artikel', [ArtikelController::class, 'index'])->name('admin.article.index');
    Route::get('/konten/artikel/tambah', [ArtikelController::class, 'add'])->name('admin.article.add');
    Route::get('/konten/artikel/edit', [ArtikelController::class, 'edit'])->name('admin.article.edit');


    Route::get('/konten/foto', [ArtikelController::class, 'index']);

    Route::get('/konten/video', [ArtikelController::class, 'index']);
    
    Route::get('/konten/publikasi', [ArtikelController::class, 'index']);
    
    Route::get('/konten/suara', [ArtikelController::class, 'index']);
});
