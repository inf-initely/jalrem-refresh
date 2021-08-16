<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kerjasama;

class KerjasamaController extends Controller
{
    public function show($slug)
    {
        $kerjasama = Kerjasama::where('slug', $slug)->firstOrFail();

        if( request()->get('lg') == 'en' ) {
            return view('content_english.kerjasama_detail', compact('kerjasama'));
        }
        
        return view('content.kerjasama_detail', compact('kerjasama'));
    }
}
