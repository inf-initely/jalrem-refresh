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
        $artikel = Artikel::where('status', 'publikasi')->paginate(9);
        $foto = Foto::where('status', 'publikasi')->paginate(9);
        $video = Video::where('status', 'publikasi')->paginate(9);
        $publikasi = Publikasi::where('status', 'publikasi')->paginate(9);
        $audio = Audio::where('status', 'publikasi')->paginate(9);


        return view('content.konten', compact('artikel', 'foto', 'video', 'publikasi', 'audio'));
    }
}
