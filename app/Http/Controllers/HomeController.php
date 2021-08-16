<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\Publikasi;
use App\Models\Foto;
use App\Models\Kegiatan;
use App\Models\Kerjasama;
use App\Models\Video;
use App\Models\Audio;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $semua_artikel = Artikel::all();
        $semua_publikasi = Publikasi::all();
        $semua_video = Video::all();
        $semua_audio = Audio::all();
        $semua_foto = Foto::all();
        $semua_kegiatan = Kegiatan::all();
        $semua_kerjasama = Kerjasama::all();

        $slider = $semua_artikel->merge($semua_publikasi)->merge($semua_video);
        
        if( request()->get('search') != null ) {
            $artikel = Artikel::where('status', 'publikasi')->where('judul_indo', 'LIKE', request()->get('search'))->orderBy('created_at', 'desc')->take(3)->get();
        } else {
            $artikel = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(3)->get();
        }
        
        $kegiatan = Kegiatan::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(3)->get();
        $video = Video::where('status', 'publikasi')->orderBy('created_at', 'desc')->get();

        if( request()->get('lg') == 'en' ) {
            return view('content_english.home', compact('artikel', 'kegiatan', 'video', 'slider'));
        } 

        return view('content.home', compact('artikel', 'kegiatan', 'video', 'slider'));
    }


}
