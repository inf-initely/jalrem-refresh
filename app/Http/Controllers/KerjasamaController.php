<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    public function show($kerjasamaId)
    {
        $kerjasama = Kerjasama::where('status', 'publikasi')->where('id', $kerjasamaId)->first();
        if( !$kerjasama )
            return abort(404);

        return view('content.kerjasama_detail', compact('kerjasama'));
    }
}
