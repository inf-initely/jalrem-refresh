<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lokasi;

use Session;

class LokasiController extends Controller
{
    public function getJSON()
    {
        if( Session::get('lg') == 'en' ) {
            $lokasi = Lokasi::orderBy('nama_lokasi_english')->get();
        } else {
            $lokasi = Lokasi::orderBy('nama_lokasi')->get();
        }
        
        return response()->json($lokasi);
    }
}
