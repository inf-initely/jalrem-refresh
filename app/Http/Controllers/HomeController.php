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
    private static $selector = "*, slug as slug_id, slug_english as slug_en,"
        ."judul_indo as judul_id, judul_english as judul_en,"
        ."meta_indo as meta_id, meta_english as meta_en";

    private function makeSliderQueries(string $lang)
    {
        $selector = HomeController::$selector;
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
        $selector = HomeController::$selector;
        return [
            "artikel" => Artikel::select(DB::raw($selector))->where('status', 'publikasi')
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<=', Carbon::now())->take(3),

            "kegiatan" => Kegiatan::select(DB::raw($selector))->where('status', 'publikasi')
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<=', Carbon::now())->take(3),

            "video" => Video::select(DB::raw($selector))->where('status', 'publikasi')
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<=', Carbon::now())->take(6),
        ];
    }

    public function index(Request $request)
    {
        $sliderQueries = $this->makeSliderQueries("id");
        $contentQueries = $this->makeContentQueries("id");

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
        $sliderQueries = $this->makeSliderQueries("en");
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

    public function index_english(Request $request)
    {
        $semua_artikel = Artikel::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_publikasi = Publikasi::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_video = Video::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_audio = Audio::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_foto = Foto::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_kegiatan = Kegiatan::where('status', 'publikasi')->where('slider_utama', 1);
        $semua_kerjasama = Kerjasama::where('status', 'publikasi')->where('slider_utama', 1);


        if (request()->get('search') != null) {
            $artikel = Artikel::where('status', 'publikasi')->where('judul_indo', 'LIKE', request()->get('search'))->orderBy('published_at', 'desc');
        } else {
            $artikel = Artikel::where('status', 'publikasi')->orderBy('published_at', 'desc');
        }

        $kegiatan = Kegiatan::where('status', 'publikasi')->orderBy('published_at', 'desc');
        $video = Video::where('status', 'publikasi')->orderBy('published_at', 'desc');

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
}
