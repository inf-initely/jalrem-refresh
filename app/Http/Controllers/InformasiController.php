<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

use App\Models\Kegiatan;
use App\Models\Kerjasama;

class InformasiController extends Controller
{
    public function index()
    {
        $kegiatan_saat_ini = Kegiatan::where('status', 'publikasi')->where('created_at', '>=', Carbon::now())->orderBy('created_at', 'desc')->get();
        $kegiatan_sebelumnya = Kegiatan::where('status', 'publikasi')->where('created_at', '<', Carbon::now())->orderBy('created_at', 'desc')->get();
        $kerjasama = Kerjasama::where('status', 'publikasi')->get();

        if( Session::get('lg') == 'en' ) {
            return view('content_english.informasi', compact('kegiatan_saat_ini', 'kegiatan_sebelumnya', 'kerjasama'));
        }

        return view('content.informasi', compact('kegiatan_saat_ini', 'kegiatan_sebelumnya', 'kerjasama'));
    }
}
