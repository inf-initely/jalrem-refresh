<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $semua_artikel = Artikel::where('status', 'publikasi')->where('slider_utama', 1)->get();
        $semua_publikasi = Publikasi::where('status', 'publikasi')->where('slider_utama', 1)->get();
        $semua_video = Video::where('status', 'publikasi')->where('slider_utama', 1)->get();
        $semua_audio = Audio::where('status', 'publikasi')->where('slider_utama', 1)->get();
        $semua_foto = Foto::where('status', 'publikasi')->where('slider_utama', 1)->get();
        $semua_kegiatan = Kegiatan::where('status', 'publikasi')->where('slider_utama', 1)->get();
        $semua_kerjasama = Kerjasama::where('status', 'publikasi')->where('slider_utama', 1)->get();

        $slider = $semua_artikel->merge($semua_publikasi)->merge($semua_video)->merge($semua_audio)->merge($semua_foto)->merge($semua_kegiatan)->merge($semua_kerjasama);
        
        if( request()->get('search') != null ) {
            $artikel = Artikel::where('status', 'publikasi')->where('judul_indo', 'LIKE', request()->get('search'))->orderBy('created_at', 'desc')->take(3)->get();
        } else {
            $artikel = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(3)->get();
        }
        
        $kegiatan = Kegiatan::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(3)->get();
        $video = Video::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(6)->get();

        if( Session::get('lg') == 'en' ) {
            return view('content_english.home', compact('artikel', 'kegiatan', 'video', 'slider'));
        } 

        return view('content.home', compact('artikel', 'kegiatan', 'video', 'slider'));
    }


}
