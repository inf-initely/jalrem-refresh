<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Publikasi;

class PublikasiController extends Controller
{
    public function index()
    {
        $publikasi = Publikasi::where('status', 'publikasi');

        if( Session::get('lg') == 'en' ) {
            $publikasi = $publikasi->where('judul_english', '!=', null)->orderBy('published_at', 'desc')->paginate(9);
            return view('content_english.publications', compact('publikasi'));
        }
        $publikasi = $publikasi->orderBy('published_at', 'desc')->paginate(9);

        return view('content.publications', compact('publikasi'));
    }

    public function show($slug)
    {
        $lg = Session::get('lg');
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';
        $query_without_this_publication = Publikasi::where('status', 'publikasi');
        $query_this_publication = Publikasi::where('slug', $slug)->orWhere('slug_english', $slug)->where('status', 'publikasi');

        $publikasi = $query_this_publication->firstOrFail();
      
        views($publikasi)->record();
        $publikasiPopuler = $query_without_this_publication->orderByViews();
        $publikasiTerbaru = $query_without_this_publication->orderBy('published_at', 'desc');
        $publikasiTerkait = $query_without_this_publication;
        $publikasiBacaJuga = $query_without_this_publication;

        $publikasi = Publikasi::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if( $publikasi->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }
        
        views($publikasi)->record();

        if( $lg == 'en' ) {
            $publikasiPopuler = $publikasiPopuler->where('judul_english', '!=', null)->take(3)->get();
            $publikasiTerbaru = $publikasiTerbaru->where('judul_english', '!=', null)->take(3)->get();
            $publikasiTerkait = $publikasiTerkait->where('judul_english', '!=', null)->take(3)->get();
            $publikasiBacaJuga = $publikasiBacaJuga->where('judul_english', '!=', null)->first();

            return view('content_english.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru', 'publikasiTerkait', 'publikasiBacaJuga'));
        }
        
        $publikasiPopuler = $publikasiPopuler->take(3)->get();
        $publikasiTerbaru = $publikasiTerbaru->take(3)->get();
        $publikasiTerkait = $publikasiTerkait->take(3)->get();
        $publikasiBacaJuga = $publikasiBacaJuga->first();
        
        return view('content.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru', 'publikasiTerkait', 'publikasiBacaJuga'));
    }
}
