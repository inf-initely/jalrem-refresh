<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::where('status', 'publikasi')->paginate(9);

        return view('content.kegiatan', compact('kegiatan'));
    }

    public function show($kegiatanId)
    {
        $kegiatan = Kegiatan::findOrFail($kegiatanId);
        $kegiatanSaatIni = Kegiatan::where('status', 'publikasi')->take(3)->get();

        return view('content.kegiatan_detail', compact('kegiatan', 'kegiatanSaatIni'));
    }
}
