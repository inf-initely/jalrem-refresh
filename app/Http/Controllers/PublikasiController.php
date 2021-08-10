<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Publikasi;

class PublikasiController extends Controller
{
    public function index()
    {
        $publikasi = Publikasi::where('status', 'publikasi')->get();

        return view('content.publications', compact('publikasi'));
    }

    public function show($publicationId)
    {
        $publikasi = Publikasi::where('status', 'publikasi')->where('id', $publicationId)->first();
        if( !$publikasi )
            return abort(404);
        views($publikasi)->record();
        $publikasiPopuler = Publikasi::orderByViews()->take(3)->get();
        // $artikelTerkait = Publikasi:
        $publikasiTerbaru = Publikasi::where('status', 'publikasi')->orderBy('created_at', 'desc')->take(3)->get();

        return view('content.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru'));
    }
}
