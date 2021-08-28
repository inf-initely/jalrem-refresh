<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kerjasama;

class KerjasamaController extends Controller
{
    public function index()
    {
        $kerjasama = Kerjasama::where('status', 'publikasi')->paginate(9);
        if( Session::get('lg') == 'en' )
            return view('content_english.kerjasama', compact('kerjasama'));

        return view('content.kerjasama', compact('kerjasama'));
    }
    public function show($slug)
    {
        $lg = Session::get('lg');

        $kerjasama = Kerjasama::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        if( $lg == 'en' )
            return view('content_english.kerjasama_detail', compact('kerjasama'));
        
        return view('content.kerjasama_detail', compact('kerjasama'));
    }
}
