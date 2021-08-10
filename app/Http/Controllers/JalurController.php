<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;

class JalurController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('status', 'publikasi')->get();

        return view('content.tentang_jalur', compact('artikel'));
    }
}
