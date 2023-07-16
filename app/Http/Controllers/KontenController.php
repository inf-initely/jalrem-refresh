<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\Artikel;
use App\Models\Foto;
use App\Models\Video;
use App\Models\Publikasi;
use App\Models\Audio;

use Carbon\Carbon;

class KontenController extends Controller
{
    private function makeContentQueries()
    {
        $selector = Controller::$content_selector;
        $now = Carbon::now();
        return [
            "artikel" => Artikel::select(DB::raw($selector))->take(9)
                ->where('status', 'publikasi')->where('published_at', '<=', $now)->orderBy('published_at', 'desc'),
            "foto" => Foto::select(DB::raw($selector))->take(9)
                ->where('status', 'publikasi')->where('published_at', '<=', $now)->orderBy('published_at', 'desc'),
            "video" => Video::select(DB::raw($selector))->take(9)
                ->where('status', 'publikasi')->where('published_at', '<=', $now)->orderBy('published_at', 'desc'),
            "publikasi" => Publikasi::select(DB::raw($selector))->take(9)
                ->where('status', 'publikasi')->where('published_at', '<=', $now)->orderBy('published_at', 'desc'),
            "audio" => Audio::select(DB::raw($selector))->take(9)
                ->where('status', 'publikasi')->where('published_at', '<=', $now)->orderBy('published_at', 'desc'),
        ];
    }

    public function index()
    {
        $queries = $this->makeContentQueries();
        $artikel = $queries["artikel"]->get();
        $foto = $queries["foto"]->get();
        $publikasi = $queries["publikasi"]->get();
        $audio = $queries["audio"]->get();
        $video = $queries["video"]->get();

        $kontenSlider = $artikel->take(3)
            ->mergeRecursive($foto->take(3))
            ->mergeRecursive($video->take(3))
            ->mergeRecursive($publikasi->take(3))
            ->mergeRecursive($audio->take(3))
            ->sortBy('desc');

        return view('content.konten', compact('artikel', 'foto', 'video', 'publikasi', 'audio', 'kontenSlider'));
    }

    public function index_en()
    {
        $queries = $this->makeContentQueries();
        $artikel = $queries["artikel"]->where('judul_english', '!=', null)->get();
        $foto = $queries["foto"]->where('judul_english', '!=', null)->get();
        $publikasi = $queries["publikasi"]->where('judul_english', '!=', null)->get();
        $audio = $queries["audio"]->where('judul_english', '!=', null)->get();
        $video = $queries["video"]->where('judul_english', '!=', null)->get();

        $kontenSlider = $artikel->take(3)
            ->mergeRecursive($foto->take(3))
            ->mergeRecursive($video->take(3))
            ->mergeRecursive($publikasi->take(3))
            ->mergeRecursive($audio->take(3))
            ->sortBy('desc');

        return view('content.konten', compact('artikel', 'foto', 'video', 'publikasi', 'audio', 'kontenSlider'));
    }
}
