<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\Kegiatan;
use App\Models\Video;

class HomeController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(3)->get();
        $kegiatan = Kegiatan::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(3)->get();
        $video = Video::where('status', 'publikasi')->orderBy('created_at', 'desc')->get();

        return view('content.home', compact('artikel', 'kegiatan', 'video'));
    }
}
