<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\Rempah;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::all();

        return view('admin.content.article.index', compact('artikels'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        return view('admin.content.article.add', compact('rempahs'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'thumbnail' => 'required|mimes:png,jpg,jpeg',
        ]);
    }

    public function edit()
    {
        return view('admin.content.article.edit');
    }
}
