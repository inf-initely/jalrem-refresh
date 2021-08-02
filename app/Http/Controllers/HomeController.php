<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;

class HomeController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(3)->get();

        return view('content.home', compact('artikel'));
    }
}
