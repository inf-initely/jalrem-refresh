<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Foto;

class FotoController extends Controller
{
    public function index()
    {
        $foto = Foto::where('status', 'publikasi')->paginate(9);

        return view('content.photos', compact('foto'));
    }

    public function show($photoId)
    {
        $foto = Foto::findOrFail($photoId);

        return view('content.photo_detail', compact('foto'));
    }
}
