<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use Illuminate\Pagination\Paginator;

use Auth;

use Carbon\Carbon;

class ArtikelController extends Controller
{

    public function index(){
        $artikel = Artikel::where('status', 'publikasi')->where('published_at', '<=', Carbon::now())->orderBy('created_at', 'desc');

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
        $query_without_this_article = Artikel::where('slug', '!=', $slug)->where('slug_english', '!=', $slug)->where('published_at', '<=', Carbon::now())->where('status', 'publikasi');
        $query_this_article = Artikel::where('slug', $slug)->orWhere('slug_english', $slug)->where('published_at', '<=', Carbon::now())->where('status', 'publikasi');

        $artikel = $query_this_article->firstOrFail();

        // check draft
        if( $artikel->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }
      
        views($artikel)->record();
        $artikelPopuler = $query_without_this_article->orderByViews();
        $artikelTerbaru = $query_without_this_article->orderBy('published_at', 'desc');
        $artikelTerkait = $query_without_this_article;
        $artikelBacaJuga = $query_without_this_article;

        if(Session::get('lg') == 'en' ) {
            if( count($query_without_this_article->get()) > 3 ) {
                $artikelPopuler = $artikelPopuler->where('judul_english', '!=', null)->take(3)->get();
                $artikelTerbaru = $artikelTerbaru->where('judul_english', '!=', null)->take(3)->get();
                $artikelTerkait = $artikelTerkait->where('judul_english', '!=', null)->take(3)->get();
                $artikelBacaJuga = $artikelBacaJuga->where('judul_english', '!=', null)->first();
            } else {
                $artikelPopuler = $artikelPopuler->where('judul_english', '!=', null)->get();
                $artikelTerbaru = $artikelTerbaru->where('judul_english', '!=', null)->get();
                $artikelTerkait = $artikelTerkait->where('judul_english', '!=', null)->get();
                $artikelBacaJuga = $artikelBacaJuga->where('judul_english', '!=', null)->first();
            }
            
            
            return view('content_english.article_detail', compact('artikel', 'artikelTerbaru', 'artikelPopuler', 'artikelBacaJuga', 'artikelTerkait'));
        }
        if( count($query_without_this_article->get()) > 3 ) {
            $artikelPopuler = $artikelPopuler->take(3)->get();
            $artikelTerkait = $artikelTerkait->take(3)->get();
            $artikelTerbaru = $artikelTerbaru->take(3)->get();
            $artikelBacaJuga = $artikelBacaJuga->first();
        } else {
            $artikelPopuler = $artikelPopuler->get();
            $artikelTerkait = $artikelTerkait->get();
            $artikelTerbaru = $artikelTerbaru->get();
            $artikelBacaJuga = $artikelBacaJuga->first();
        }
    
        return view('content.article_detail', compact('artikel', 'artikelTerbaru', 'artikelPopuler', 'artikelBacaJuga', 'artikelTerkait'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        if(Session::get('lg') == 'en' ) {

            $artikel = Artikel::when($search != null, function($query) use ($search) {
                $query->where('status', 'publikasi')->orderBy('created_at', 'desc')->where('judul_english', 'LIKE', '%'.$search . '%')->where('published_at', '<=', Carbon::now());
            })->where('judul_english', '!=', null)->paginate(9);

            return view('content_english.articles', compact('artikel'));
        }

        $artikel = Artikel::when($search != null, function($query) use ($search) {
            $query->where('status', 'publikasi')->orderBy('created_at', 'desc')->where('judul_english', 'LIKE', '%'.$search . '%')->where('published_at', '<=', Carbon::now());
        })->paginate(9);

        return view('content.articles', compact('artikel'));
    }
}
