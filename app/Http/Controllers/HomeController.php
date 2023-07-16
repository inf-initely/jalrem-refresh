<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
    private function makeSliderQueries()
    {
        $selector = Controller::$content_selector;
        return [
            "artikel" => Artikel::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "publikasi" => Publikasi::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "video" => Video::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "audio" => Audio::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "foto" => Foto::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "kegiatan" => Kegiatan::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "kerjasama" => Kerjasama::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
        ];
    }

    private function makeContentQueries()
    {
        $selector = Controller::$content_selector;
        $now = Carbon::now();
        return [
            "artikel" => Artikel::select(DB::raw($selector))->where('status', 'publikasi')
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<=', $now)->take(3),

            "kegiatan" => Kegiatan::select(DB::raw($selector))->where('status', 'publikasi')
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<=', $now)->take(3),

            "video" => Video::select(DB::raw($selector))->where('status', 'publikasi')
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<=', $now)->take(6),
        ];
    }

    public function index(Request $request)
    {
        $sliderQueries = $this->makeSliderQueries();
        $contentQueries = $this->makeContentQueries();

        $semua_artikel = $sliderQueries["artikel"]->get();
        $semua_audio = $sliderQueries["audio"]->get();
        $semua_foto = $sliderQueries["foto"]->get();
        $semua_kegiatan = $sliderQueries["kegiatan"]->get();
        $semua_kerjasama = $sliderQueries["kerjasama"]->get();
        $semua_video = $sliderQueries["video"]->get();
        $semua_publikasi = $sliderQueries["publikasi"]->get();

        $slider = $semua_artikel->mergeRecursive($semua_publikasi)->mergeRecursive($semua_video)->mergeRecursive($semua_audio)->mergeRecursive($semua_foto)->mergeRecursive($semua_kegiatan)->mergeRecursive($semua_kerjasama);
        $artikel = $contentQueries["artikel"]->get();
        $kegiatan = $contentQueries["kegiatan"]->get();
        $video = $contentQueries["video"]->get();

        return view('content.home', compact('artikel', 'kegiatan', 'video', 'slider'));
    }

    public function index_en(Request $request)
    {
        $sliderQueries = $this->makeSliderQueries();
        $contentQueries = $this->makeContentQueries();

        $semua_artikel = $sliderQueries["artikel"]->where('judul_english', '!=', null)->get();
        $semua_audio = $sliderQueries["audio"]->where('judul_english', '!=', null)->get();
        $semua_foto = $sliderQueries["foto"]->where('judul_english', '!=', null)->get();
        $semua_kegiatan = $sliderQueries["kegiatan"]->where('judul_english', '!=', null)->get();
        $semua_kerjasama = $sliderQueries["kerjasama"]->where('judul_english', '!=', null)->get();
        $semua_video = $sliderQueries["video"]->where('judul_english', '!=', null)->get();
        $semua_publikasi = $sliderQueries["publikasi"]->where('judul_english', '!=', null)->get();

        $slider = $semua_artikel->mergeRecursive($semua_publikasi)->mergeRecursive($semua_video)->mergeRecursive($semua_audio)->mergeRecursive($semua_foto)->mergeRecursive($semua_kegiatan)->mergeRecursive($semua_kerjasama);
        $artikel = $contentQueries["artikel"]->where('judul_english', '!=', null)->get();
        $kegiatan = $contentQueries["kegiatan"]->where('judul_english', '!=', null)->get();
        $video = $contentQueries["video"]->where('judul_english', '!=', null)->get();

        return view('content.home', compact('artikel', 'kegiatan', 'video', 'slider'));
    }
}
