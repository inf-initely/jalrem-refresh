<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;
use Illuminate\Pagination\Paginator;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('status', 'publikasi')->paginate(9);

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

    public function search(Request $request)
    {
        $search = $request->get('search');

        if( $search != null ) {
            $artikel = Artikel::where('status', 'publikasi')->where('judul_indo', 'LIKE', '%'.$request->get('search') . '%')->orderBy('created_at', 'desc')->paginate(9);
        } else {
            $artikel = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc')->paginate(9);
        }

        return view('content.articles', compact('artikel'));
    }
}
