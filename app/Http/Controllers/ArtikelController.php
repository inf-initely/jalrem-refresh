<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use Illuminate\Pagination\Paginator;

class ArtikelController extends Controller
{

    public function index(){
        $artikel = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc');

        if(Session::get('lg') == 'en' ) {
            $artikel = $artikel->where('judul_english', '!=', null)->paginate(9);
            return view('content_english.articles', compact('artikel'));
        }

        $artikel = $artikel->paginate(9);

        return view('content.articles', compact('artikel'));
    }

    public function show(Request $request, $slug)
    {
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';
        $query_without_this_article = Artikel::where('slug', '!=', $slug)->where('slug_english', '!=', $slug);
        $query_this_article = Artikel::where('slug', $slug)->orWhere('slug_english', $slug);

        $artikel = $query_this_article->firstOrFail();
      
        views($artikel)->record();
        $artikelPopuler = $query_without_this_article->orderByViews();
        $artikelTerbaru = $query_without_this_article->orderBy('created_at', 'desc');
        $artikelBacaJuga = $query_without_this_article;

        if(Session::get('lg') == 'en' ) {
            $artikelPopuler = $artikelPopuler->where('judul_english', '!=', null)->take(3)->get();
            $artikelTerbaru = $artikelTerbaru->where('judul_english', '!=', null)->take(3)->get();
            $artikelBacaJuga = $artikelBacaJuga->where('judul_english', '!=', null)->first();
            
            return view('content_english.article_detail', compact('artikel', 'artikelTerbaru', 'artikelPopuler', 'artikelBacaJuga'));
        }
        $artikelPopuler = $artikelPopuler->take(3)->get();
        $artikelTerbaru = $artikelTerbaru->take(3)->get();
        $artikelBacaJuga = $artikelBacaJuga->first();

        return view('content.article_detail', compact('artikel', 'artikelTerbaru', 'artikelPopuler', 'artikelBacaJuga'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        if(Session::get('lg') == 'en' ) {

            $artikel = Artikel::when($search != null, function($query) use ($search) {
                $query->where('status', 'publikasi')->orderBy('created_at', 'desc')->where('judul_english', 'LIKE', '%'.$search . '%');
            })->where('judul_english', '!=', null)->paginate(9);

            return view('content_english.articles', compact('artikel'));
        }

        $artikel = Artikel::when($search != null, function($query) use ($search) {
            $query->where('status', 'publikasi')->orderBy('created_at', 'desc')->where('judul_english', 'LIKE', '%'.$search . '%');
        })->paginate(9);

        return view('content.articles', compact('artikel'));
    }
}
