<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use App\Models\KategoriShow;

class JalurController extends Controller
{
    public function index()
    {
        abort(503);
        $kategori = KategoriShow::where('isi', 'jalur')->first();
        $artikel = ( $kategori != null )
            ? $kategori->artikel
            : [];

        if( Session::get('lg') == 'en' )
            return view('content_english.tentang_jalur', compact('artikel'));

        return view('content.tentang_jalur', compact('artikel'));
    }
}
