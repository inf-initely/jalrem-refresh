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
        if( Session::get('lg') == 'en' ) {
            return redirect()->route('informasi.english');
        }
        $kerjasama = Kerjasama::where('status', 'publikasi')->where('published_at', '<=', Carbon::now());

        $kegiatan_saat_ini = $this->getQueryPublication('>');
        $kegiatan_sebelumnya = $this->getQueryPublication('<=');

        $kerjasama = $kerjasama->take(6)->get();
        $kegiatan_saat_ini = $kegiatan_saat_ini->take(6)->get();
        $kegiatan_sebelumnya = $kegiatan_sebelumnya->take(6)->get();

        return view('content.informasi', compact('kegiatan_saat_ini', 'kegiatan_sebelumnya', 'kerjasama'));
    }

    public function index_english()
    {
        if( Session::get('lg') != 'en' ) {
            return redirect()->route('informasi');
        }
        $kerjasama = Kerjasama::where('status', 'publikasi')->where('published_at', '<=', Carbon::now());

        $kegiatan_saat_ini = $this->getQueryPublication('>');
        $kegiatan_sebelumnya = $this->getQueryPublication('<=');

        $kerjasama->where('judul_english', '!=', null)->take(6)->get();
        $kegiatan_saat_ini = $kegiatan_saat_ini->where('judul_english', '!=', null)->take(6)->get();
        $kegiatan_sebelumnya = $kegiatan_sebelumnya->where('judul_english', '!=', null)->take(6)->get();

        return view('content_english.informasi', compact('kegiatan_saat_ini', 'kegiatan_sebelumnya', 'kerjasama'));
    }

    private function getQueryPublication($sign)
    {
        return Kegiatan::where('status', 'publikasi')->where('published_at', '<=', Carbon::now())->where('end_date', $sign, Carbon::now())->orderBy('published_at', 'desc');
    }
}
