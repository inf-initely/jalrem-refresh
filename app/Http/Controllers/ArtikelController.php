<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use Illuminate\Pagination\Paginator;

class ArtikelController extends Controller
{

    public function index(){
        $artikel = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc')->paginate(9);

        if(Session::get('lg') == 'en' ) {
            return view('content_english.articles', compact('artikel'));
        }

        return view('content.articles', compact('artikel'));
    }

    public function show(Request $request, $slug)
    {
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';
        $query_without_this_article = Artikel::where('slug', '!=', $slug)->orWhere('slug_english', '!=', $slug);
        $query_this_article = Artikel::where('slug', $slug)->orWhere('slug_english', $slug);

        $artikel = $query_this_article->firstOrFail();
      
        views($artikel)->record();
        $artikelPopuler = $query_without_this_article->orderByViews()->take(3)->get();
        $artikelTerbaru = $query_without_this_article->orderBy('created_at', 'desc')->take(3)->get();
        $artikelBacaJuga = $query_without_this_article->first();

        if(Session::get('lg') == 'en' ) 
            return view('content_english.article_detail', compact('artikel', 'artikelTerbaru', 'artikelPopuler', 'artikelBacaJuga'));

        return view('content.article_detail', compact('artikel', 'artikelTerbaru', 'artikelPopuler', 'artikelBacaJuga'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        if(Session::get('lg') == 'en' ) {

            $artikel = Artikel::when($search != null, function($query) use ($search) {
                $query->where('status', 'publikasi')->orderBy('created_at', 'desc')->where('judul_english', 'LIKE', '%'.$search . '%');
            })->paginate(9);

            return view('content_english.articles', compact('artikel'));
        }

        $artikel = Artikel::when($search != null, function($query) use ($search) {
            $query->where('status', 'publikasi')->orderBy('created_at', 'desc')->where('judul_english', 'LIKE', '%'.$search . '%');
        })->paginate(9);

        return view('content.articles', compact('artikel'));
    }
}
