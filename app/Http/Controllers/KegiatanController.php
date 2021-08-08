<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        return view('content.kegiatan');
    }

    public function show()
    {
        return view('content.kegiatan_detail');
    }
}
