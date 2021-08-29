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
        $artikelSlider = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc');
        $artikel = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc');
        $foto = Foto::where('status', 'publikasi')->orderBy('created_at', 'desc');
        $video = Video::where('status', 'publikasi')->orderBy('created_at', 'desc');
        $publikasi = Publikasi::where('status', 'publikasi')->orderBy('created_at', 'desc');
        $audio = Audio::where('status', 'publikasi')->orderBy('created_at', 'desc');
        
        if( Session::get('lg') == 'en' ) {
            $artikelSlider = $artikelSlider->where('judul_english', '!=', null)->take(3)->get();
            $artikel = $this->getQuery($artikel);
            $foto = $this->getQuery($foto);
            $video = $this->getQuery($video);
            $publikasi = $this->getQuery($publikasi);
            $audio = $this->getQuery($audio);

            return view('content_english.konten', compact('artikel', 'foto', 'video', 'publikasi', 'audio', 'artikelSlider'));
        }

        $artikel = $artikel->take(9)->get();
        $foto = $foto->take(9)->get();
        $video = $video->take(9)->get();
        $publikasi = $publikasi->take(9)->get();
        $audio = $audio->take(9)->get();

        return view('content.konten', compact('artikel', 'foto', 'video', 'publikasi', 'audio', 'artikelSlider'));
    }

    private function getQuery($konten)
    {
        return $konten->where('judul_english', '!=', null)->take(9)->get();
    }

}
