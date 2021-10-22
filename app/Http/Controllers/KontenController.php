<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use App\Models\Foto;
use App\Models\Video;
use App\Models\Publikasi;
use App\Models\Audio;


class KontenController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('status', 'publikasi')->where('published_at', '<=', \Carbon\Carbon::now())->orderBy('published_at', 'desc');
        $foto = Foto::where('status', 'publikasi')->where('published_at', '<=', \Carbon\Carbon::now())->orderBy('published_at', 'desc');
        $video = Video::where('status', 'publikasi')->where('published_at', '<=', \Carbon\Carbon::now())->orderBy('published_at', 'desc');
        $publikasi = Publikasi::where('status', 'publikasi')->where('published_at', '<=', \Carbon\Carbon::now())->orderBy('published_at', 'desc');
        $audio = Audio::where('status', 'publikasi')->where('published_at', '<=', \Carbon\Carbon::now())->orderBy('published_at', 'desc');

        
        if( Session::get('lg') == 'en' ) {
            $kontenSlider = $artikel->take(3)->get()->mergeRecursive($foto->take(3)->get())->mergeRecursive($video->take(3)->get())->mergeRecursive($publikasi->take(3)->get())->mergeRecursive($audio->take(3)->get())->filter(function($item) {
                return ($item->judul_english != null);
            })->sortBy('desc');
            $artikel = $this->getQuery($artikel);
            $foto = $this->getQuery($foto);
            $video = $this->getQuery($video);
            $publikasi = $this->getQuery($publikasi);
            $audio = $this->getQuery($audio);

            return view('content_english.konten', compact('artikel', 'foto', 'video', 'publikasi', 'audio', 'kontenSlider'));
        }
        // $kontenSlider = $kontenSlider->take(5)->get();
        $kontenSlider = $artikel->take(3)->get()->mergeRecursive($foto->take(3)->get())->mergeRecursive($video->take(3)->get())->mergeRecursive($publikasi->take(3)->get())->mergeRecursive($audio->take(3)->get())->sortBy('desc');
        $artikel = $artikel->take(9)->get();
        $foto = $foto->take(9)->get();
        $video = $video->take(9)->get();
        $publikasi = $publikasi->take(9)->get();
        $audio = $audio->take(9)->get();

        return view('content.konten', compact('artikel', 'foto', 'video', 'publikasi', 'audio', 'kontenSlider'));
    }

    private function getQuery($konten)
    {
        return $konten->where('judul_english', '!=', null)->take(9)->get();
    }

}
