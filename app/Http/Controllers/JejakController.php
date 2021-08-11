<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\KategoriShow;

class JejakController extends Controller
{
    public function index()
    {
        $kategori = KategoriShow::where('isi', 'jejak')->first();
        if( $kategori != null ) {
            $artikel = $kategori->artikel;
        } else {
            $artikel = [];
        }

        return view('content.tentang_jejak', compact('artikel'));
    }
}
