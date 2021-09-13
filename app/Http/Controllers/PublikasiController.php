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
            $publikasi = $publikasi->where('judul_english', '!=', null)->paginate(9);
            return view('content_english.publications', compact('publikasi'));
        }
        $publikasi = $publikasi->paginate(9);

        return view('content.publications', compact('publikasi'));
    }

    public function show($slug)
    {
        $lg = Session::get('lg');
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';
        $query_without_this_publication = Publikasi::where('slug', '!=', $slug)->where('slug_english', '!=', $slug);
        $query_this_publication = Publikasi::where('slug', $slug)->orWhere('slug_english', $slug);

        $publikasi = $query_this_publication->firstOrFail();
      
        views($publikasi)->record();
        $publikasiPopuler = $query_without_this_publication->orderByViews();
        $publikasiTerbaru = $query_without_this_publication->orderBy('created_at', 'desc');
        $publikasiTerkait = $query_without_this_publication;
        $publikasiBacaJuga = $query_without_this_publication;

        $publikasi = Publikasi::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();
        
        views($publikasi)->record();

        if( $lg == 'en' ) {
            if( count($query_without_this_publication->get()) > 3 ) {
                $publikasiPopuler = $publikasiPopuler->where('judul_english', '!=', null)->get()->random(3)->values();
                $publikasiTerbaru = $publikasiTerbaru->where('judul_english', '!=', null)->get()->random(3)->values();
                $publikasiTerkait = $publikasiTerbaru->where('judul_english', '!=', null)->get()->random(3)->values();
                $publikasiBacaJuga = $publikasiTerbaru->where('judul_english', '!=', null)->get()->random(1)->values();
            }else {
                $publikasiPopuler = $publikasiPopuler->where('judul_english', '!=', null)->get();
                $publikasiTerbaru = $publikasiTerbaru->where('judul_english', '!=', null)->get();
                $publikasiTerkait = $publikasiTerkait->where('judul_english', '!=', null)->get();
                $publikasiBacaJuga = $publikasiTerbaru->where('judul_english', '!=', null)->first();
            }
            return view('content_english.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru', 'publikasiTerkait', 'publikasiBacaJuga'));
        }
        if( count($query_without_this_publication->get()) > 3 ) {
            $publikasiPopuler = $publikasiPopuler->get()->random(3)->values();
            $publikasiTerbaru = $publikasiTerbaru->get()->random(3)->values();
            $publikasiTerkait = $publikasiTerkait->get()->random(3)->values();
            $publikasiBacaJuga = $publikasiTerbaru->get()->random(1)->values();
        } else {
            $publikasiPopuler = $publikasiPopuler->get();
            $publikasiTerbaru = $publikasiTerbaru->get();
            $publikasiTerkait = $publikasiTerkait->get();
            $publikasiBacaJuga = $publikasiTerbaru->first();
        }
        
        return view('content.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru', 'publikasiTerkait', 'publikasiBacaJuga'));
    }
}
