<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kerjasama;

class KerjasamaController extends Controller
{
    public function index()
    {
        $kerjasama = Kerjasama::where('status', 'publikasi');

        if( Session::get('lg') == 'en' ) {
            $kerjasama = $kerjasama->where('judul_english', '!=', null)->paginate(9);
            return view('content_english.kerjasama', compact('kerjasama'));
        }
        
        $kerjasama = $kerjasama->paginate(9);

        return view('content.kerjasama', compact('kerjasama'));
    }
    public function show($slug)
    {
        $lg = Session::get('lg');

        $kerjasama = Kerjasama::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if( $kerjasama->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        if( $lg == 'en' )
            return view('content_english.kerjasama_detail', compact('kerjasama'));
        
        return view('content.kerjasama_detail', compact('kerjasama'));
    }
}
