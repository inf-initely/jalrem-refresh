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


        $publikasi = Publikasi::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();
        
        views($publikasi)->record();
        $publikasiPopuler = Publikasi::where('slug', '!=', $slug)->where('slug_english', '!=', $slug)->orderByViews();
        // publikasiTerkait = Publikasi::
        $publikasiTerbaru = Publikasi::where('slug', '!=', $slug)->where('slug_english','!=', $slug)->orderBy('created_at', 'desc');

        if( $lg == 'en' ) {
            $publikasiPopuler = $publikasiPopuler->where('judul_english', '!=', null)->take(3)->get();
            $publikasiTerbaru = $publikasiTerbaru->where('judul_english', '!=', null)->take(3)->get();

            return view('content_english.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru'));
        }
        $publikasiPopuler = $publikasiPopuler->take(3)->get();
        $publikasiTerbaru = $publikasiTerbaru->take(3)->get();
        
        return view('content.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru'));
    }
}
