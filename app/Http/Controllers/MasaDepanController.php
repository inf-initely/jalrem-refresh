<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\KategoriShow;

class MasaDepanController extends Controller
{
    public function index()
    {
        $kategori = KategoriShow::where('isi', 'masa depan')->first();
        if( $kategori != null ) {
            $artikel = $kategori->artikel;
        } else {
            $artikel = [];
        }

        if( request()->get('lg') == 'en' ) {
            return view('content_english.tentang_masadepan', compact('artikel'));
        }

        return view('content.tentang_masadepan', compact('artikel'));
    }
}
