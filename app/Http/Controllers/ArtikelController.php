<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use Illuminate\Pagination\Paginator;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc')->paginate(9);

        if( Session::get('lg') == 'en' ) {
            return view('content_english.articles', compact('artikel'));
        }

        return view('content.articles', compact('artikel'));
    }

    public function show(Request $request, $slug)
    {
        $lg = Session::get('lg');
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';

        $artikel = Artikel::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();
      
        views($artikel)->record();
        $artikelPopuler = Artikel::where('slug', '!=', $slug)->orWhere('slug_english', '!=', $slug)->orderByViews()->take(3)->get();
        // $artikelTerkait = Artikel::
        $artikelTerbaru = Artikel::where('slug', '!=', $slug)->orWhere('slug_english', '!=', $slug)->orderBy('created_at', 'desc')->take(3)->get();

        if( $lg == 'en' ) 
            return view('content_english.article_detail', compact('artikel', 'artikelTerbaru', 'artikelPopuler'));

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

        if( $request->get('lg') == 'en' ) {
            return view('content_english.articles', compact('artikel'));
        }

        return view('content.articles', compact('artikel'));
    }
}
