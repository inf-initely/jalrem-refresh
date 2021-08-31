<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Rempah;

class RempahController extends Controller
{
    public function show($rempahId)
    {
        $rempah = Rempah::findOrFail($rempahId);
        $rempahs = Rempah::all();
        $artikelRempah = $rempah->artikel;

        if( Session::get('lg') == 'en' )
            return view('content_english.rempah_detail', compact('rempah', 'artikelRempah', 'rempahs'));

        return view('content.rempah_detail', compact('rempah', 'artikelRempah', 'rempahs'));
    }

    public function getJSON()
    {
        $rempah = Rempah::all();

        return response()->json($rempah);
    }
}
