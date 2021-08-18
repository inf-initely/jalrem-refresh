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
        $artikelSlider = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(3)->get();
        $artikel = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc')->paginate(9);
        $foto = Foto::where('status', 'publikasi')->orderBy('created_at', 'desc')->paginate(9);
        $video = Video::where('status', 'publikasi')->orderBy('created_at', 'desc')->paginate(9);
        $publikasi = Publikasi::where('status', 'publikasi')->orderBy('created_at', 'desc')->paginate(9);
        $audio = Audio::where('status', 'publikasi')->orderBy('created_at', 'desc')->paginate(9);
        
        if( Session::get('lg') == 'en' ) {
            return view('content_english.konten', compact('artikel', 'foto', 'video', 'publikasi', 'audio', 'artikelSlider'));
        }

        return view('content.konten', compact('artikel', 'foto', 'video', 'publikasi', 'audio', 'artikelSlider'));
    }
}
