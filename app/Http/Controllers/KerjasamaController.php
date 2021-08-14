<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kerjasama;

class KerjasamaController extends Controller
{
    public function show($slug)
    {
        $kerjasama = Kerjasama::where('slug', $slug)->firstOrFail();
        
        return view('content.kerjasama_detail', compact('kerjasama'));
    }
}
