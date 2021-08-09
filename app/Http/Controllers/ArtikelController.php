<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('status', 'publikasi')->get();

        return view('content.articles', compact('artikel'));
    }

    public function show($articleId)
    {
        $artikel = Artikel::where('status', 'publikasi')->where('id', $articleId)->first();
        if( !$artikel )
            return abort(404);
        views($artikel)->record();
        $artikelPopuler = Artikel::orderByViews()->take(3)->get();
        // $artikelTerkait = Artikel::
        $artikelTerbaru = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(3)->get();

        return view('content.article_detail', compact('artikel', 'artikelTerbaru', 'artikelPopuler'));
    }
}
