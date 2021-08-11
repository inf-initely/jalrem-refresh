<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kerjasama;

class KerjasamaController extends Controller
{
    public function show($kerjasamaId)
    {
        $kerjasama = Kerjasama::findOrFail($kerjasamaId);
        
        return view('content.kerjasama_detail', compact('kerjasama'));
    }
}
