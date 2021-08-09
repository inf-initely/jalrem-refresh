<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::where('status', 'publikasi')->get();

        return view('content.kegiatan', compact('kegiatan'));
    }

    public function show()
    {
        return view('content.kegiatan_detail');
    }
}
