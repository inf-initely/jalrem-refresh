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
        $artikel = Artikel::findOrFail($articleId);
      
        views($artikel)->record();
        $artikelPopuler = Artikel::where('id', '!=', $articleId)->orderByViews()->take(3)->get();
        // $artikelTerkait = Artikel::
        $artikelTerbaru = Artikel::where('id', '!=', $articleId)->orderBy('created_at', 'desc')->take(3)->get();

        return view('content.article_detail', compact('artikel', 'artikelTerbaru', 'artikelPopuler'));
    }
}
