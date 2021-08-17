<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::where('status', 'publikasi')->paginate(9);

        if( Session::get('lg') == 'en' ) {
            return view('content_english.kegiatan', compact('kegiatan'));
        }

        return view('content.kegiatan', compact('kegiatan'));
    }

    public function show($slug)
    {
        $kegiatan = Kegiatan::where('slug',$slug)->firstOrFail();
        
        $kegiatanSaatIni = Kegiatan::where('status', 'publikasi')->take(3)->get();

        if( Session::get('lg') == 'en' ) {
            return view('content_english.kegiatan_detail', compact('kegiatan', 'kegiatanSaatIni'));
        }

        return view('content.kegiatan_detail', compact('kegiatan', 'kegiatanSaatIni'));
    }
}
