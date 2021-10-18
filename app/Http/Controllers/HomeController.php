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

use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $semua_artikel = Artikel::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_publikasi = Publikasi::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_video = Video::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_audio = Audio::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_foto = Foto::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_kegiatan = Kegiatan::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_kerjasama = Kerjasama::where('status', 'publikasi')->where('slider_utama', 1);

        
        if( request()->get('search') != null ) {
            $artikel = Artikel::where('status', 'publikasi')->where('judul_indo', 'LIKE', request()->get('search'))->orderBy('published_at', 'desc');
        } else {
            $artikel = Artikel::where('status', 'publikasi')->orderBy('published_at', 'desc');
        }
        
        $kegiatan = Kegiatan::where('status', 'publikasi')->orderBy('published_at', 'desc');
        $video = Video::where('status', 'publikasi')->orderBy('published_at', 'desc');

        if( Session::get('lg') == 'en' ) {
            $semua_artikel = $semua_artikel->where('judul_english', '!=', null)->get();
            $semua_audio = $semua_audio->where('judul_english', '!=', null)->get();
            $semua_foto = $semua_foto->where('judul_english', '!=', null)->get();
            $semua_kegiatan = $semua_kegiatan->where('judul_english', '!=', null)->get();
            $semua_kerjasama = $semua_kerjasama->where('judul_english', '!=', null)->get();
            $semua_video = $semua_video->where('judul_english', '!=', null)->get();
            $semua_publikasi = $semua_publikasi->where('judul_english', '!=', null)->get();

            $artikel = $artikel->where('judul_english', '!=', null)->where('published_at', '<=', Carbon::now())->take(3)->get();

            $kegiatan = $kegiatan->where('judul_english', '!=', null)->where('published_at', '<=', Carbon::now())->take(3)->get();
            $video = $video->where('judul_english', '!=', null)->where('published_at', '<=', Carbon::now())->take(6)->get();

            $slider = $semua_artikel->mergeRecursive($semua_publikasi)->mergeRecursive($semua_video)->mergeRecursive($semua_audio)->mergeRecursive($semua_foto)->mergeRecursive($semua_kegiatan)->mergeRecursive($semua_kerjasama);

            return view('content_english.home', compact('artikel', 'kegiatan', 'video', 'slider'));
        } 
        $semua_artikel = $semua_artikel->get();
        $semua_audio = $semua_audio->get();
        $semua_foto = $semua_foto->get();
        $semua_kegiatan = $semua_kegiatan->get();
        $semua_kerjasama = $semua_kerjasama->get();
        $semua_video = $semua_video->get();
        $semua_publikasi = $semua_publikasi->get();

        $artikel = $artikel->where('published_at', '<=', Carbon::now())->take(3)->get();
        $slider = $semua_artikel->mergeRecursive($semua_publikasi)->mergeRecursive($semua_video)->mergeRecursive($semua_audio)->mergeRecursive($semua_foto)->mergeRecursive($semua_kegiatan)->mergeRecursive($semua_kerjasama);

        $kegiatan = $kegiatan->where('published_at', '<=', Carbon::now())->take(3)->get();
        $video = $video->where('published_at', '<=', Carbon::now())->take(6)->get();

        return view('content.home', compact('artikel', 'kegiatan', 'video', 'slider'));
    }


}
