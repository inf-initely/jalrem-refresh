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
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{

    const selector = "*, slug as slug_id, slug_english as slug_en,"
        ."judul_indo as judul_id, judul_english as judul_en,"
        ."meta_indo as meta_id, meta_english as meta_en";

    private function makeSliderQueries(string $lang = "id")
    {
        $selector = HomeController::selector;
        $sliders = [
            "artikel" => Artikel::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "publikasi" => Publikasi::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "video" => Video::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "audio" => Audio::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "foto" => Foto::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "kegiatan" => Kegiatan::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
            "kerjasama" => Kerjasama::select(DB::raw($selector))->where('status', 'publikasi')->where('slider_utama', 1),
        ];

        if($lang == "en") {
            $sliders["artikel"]->where('judul_english', '!=', null);
            $sliders["publikasi"]->where('judul_english', '!=', null);
            $sliders["video"]->where('judul_english', '!=', null);
            $sliders["audio"]->where('judul_english', '!=', null);
            $sliders["foto"]->where('judul_english', '!=', null);
            $sliders["kegiatan"]->where('judul_english', '!=', null);
            $sliders["kerjasama"]->where('judul_english', '!=', null);
        }

        return $sliders;
    }

    private function makeContentQueries(string $lang = "id")
    {
        $selector = HomeController::selector;
        $now = Carbon::now();
        $contents = [
            "artikel" => Artikel::select(DB::raw($selector))->where('status', 'publikasi')
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<=', $now),

            "kegiatan" => Kegiatan::select(DB::raw($selector))->where('status', 'publikasi')
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<=', $now),

            "video" => Video::select(DB::raw($selector))->where('status', 'publikasi')
                ->orderBy('published_at', 'desc')
                ->where('published_at', '<=', $now),
        ];


        if($lang == "en") {
            $contents["artikel"]->where('judul_english', '!=', null);
            $contents["kegiatan"]->where('judul_english', '!=', null);
            $contents["video"]->where('judul_english', '!=', null);
        }

        return $contents;
    }

    public function index(Request $request)
    {
        $lang = App::getLocale();
        $sliderQueries = $this->makeSliderQueries($lang);
        $contentQueries = $this->makeContentQueries($lang);

        $slider = $sliderQueries["artikel"]->get()
            ->mergeRecursive($sliderQueries["audio"]->get())
            ->mergeRecursive($sliderQueries["foto"]->get())
            ->mergeRecursive($sliderQueries["kegiatan"]->get())
            ->mergeRecursive($sliderQueries["kerjasama"]->get())
            ->mergeRecursive($sliderQueries["video"]->get())
            ->mergeRecursive($sliderQueries["publikasi"]->get());

        $artikel = $contentQueries["artikel"]->forPage(1, 3)->get();
        $kegiatan = $contentQueries["kegiatan"]->forPage(1, 3)->get();

        return view('content.home', compact('artikel', 'kegiatan', 'slider'));
    }
}
