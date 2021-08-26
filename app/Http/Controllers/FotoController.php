<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Foto;

class FotoController extends Controller
{
    public function index()
    {
        $foto = Foto::where('status', 'publikasi')->orderBy('created_at', 'desc')->paginate(9);

        if( Session::get('lg') == 'en' )
            return view('content_english.photos', compact('foto'));

        return view('content.photos', compact('foto'));
    }

    public function show($slug)
    {
        $lg = Session::get('lg');

        $foto = Foto::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();
        
        if( $lg == 'en' )
            return view('content_english.photo_detail', compact('foto'));

        return view('content.photo_detail', compact('foto'));
    }
}
