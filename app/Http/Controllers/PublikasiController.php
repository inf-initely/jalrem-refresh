<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Publikasi;

class PublikasiController extends Controller
{
    public function index()
    {
        $publikasi = Publikasi::where('status', 'publikasi')->paginate(9);

        if( Session::get('lg') == 'en' )
            return view('content_english.publications', compact('publikasi'));

        return view('content.publications', compact('publikasi'));
    }

    public function show($slug)
    {
        $lg = Session::get('lg');
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';


        $publikasi = Publikasi::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();
        
        views($publikasi)->record();
        $publikasiPopuler = Publikasi::where('slug', '!=', $slug)->orWhere('slug_english', '!=', $slug)->orderByViews()->take(3)->get();
        // publikasiTerkait = Publikasi::
        $publikasiTerbaru = Publikasi::where('slug', '!=', $slug)->orWhere('slug_english','!=', $slug)->orderBy('created_at', 'desc')->take(3)->get();

        if( $lg == 'en' ) {
            return view('content_english.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru'));
        }
        
        return view('content.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru'));
    }
}
