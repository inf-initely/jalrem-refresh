<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Foto;

use Carbon\Carbon;

class FotoController extends Controller
{
    public function index()
    {
        $foto = Foto::where('status', 'publikasi')->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc');

        if( Session::get('lg') == 'en' ){
            $foto = $foto->where('judul_english', '!=', null)->paginate(9);
            return view('content_english.photos', compact('foto'));
        }
        $foto = $foto->paginate(9);

        return view('content.photos', compact('foto'));
    }

    public function show($slug)
    {
        $lg = Session::get('lg');

        $foto = Foto::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if( $foto->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }
        
        if( $lg == 'en' )
            return view('content_english.photo_detail', compact('foto'));

        return view('content.photo_detail', compact('foto'));
    }
}
