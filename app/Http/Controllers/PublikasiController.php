<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Publikasi;

class PublikasiController extends Controller
{
    public function index()
    {
        $publikasi = Publikasi::where('status', 'publikasi')->paginate(9);

        if( Session::get('lg') == 'en' ) {
            return view('content_english.publications', compact('publikasi'));
        }

        return view('content.publications', compact('publikasi'));
    }

    public function show($slug)
    {
        $publikasi = Publikasi::where('slug', $slug)->firstOrFail();
        
        views($publikasi)->record();
        $publikasiPopuler = Publikasi::where('status', 'publikasi')->orderByViews()->take(3)->get();
        // $artikelTerkait = Publikasi:
        $publikasiTerbaru = Publikasi::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(3)->get();

        if( request()->get('lg') == 'en' ) {
            return view('content_english.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru'));
        }
        
        return view('content.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru'));
    }
}
