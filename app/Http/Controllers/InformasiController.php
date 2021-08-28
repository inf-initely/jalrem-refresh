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
        $kerjasama = Kerjasama::where('status', 'publikasi')->take(6)->get();

        $kegiatan_saat_ini = $this->getQueryPublication('>');
        $kegiatan_sebelumnya = $this->getQueryPublication('<=');

        if( Session::get('lg') == 'en' )
            return view('content_english.informasi', compact('kegiatan_saat_ini', 'kegiatan_sebelumnya', 'kerjasama'));

        return view('content.informasi', compact('kegiatan_saat_ini', 'kegiatan_sebelumnya', 'kerjasama'));
    }

    private function getQueryPublication($sign)
    {
        return Kegiatan::where('status', 'publikasi')->where('end_date', $sign, Carbon::now())->orderBy('created_at', 'desc')->take(6)->get();
    }
}
