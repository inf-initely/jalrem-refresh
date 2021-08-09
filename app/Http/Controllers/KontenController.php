<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\Foto;
use App\Models\Video;
use App\Models\Publikasi;
use App\Models\Audio;

class KontenController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('status', 'publikasi')->get();
        $foto = Foto::where('status', 'publikasi')->get();
        $video = Video::where('status', 'publikasi')->get();
        $publikasi = Publikasi::where('status', 'publikasi')->get();
        $audio = Audio::where('status', 'publikasi')->get();


        return view('content.konten', compact('artikel', 'foto', 'video', 'publikasi', 'audio'));
    }
}
