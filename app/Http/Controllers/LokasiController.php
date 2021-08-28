<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lokasi;

class LokasiController extends Controller
{
    public function getJSON()
    {
        $lokasi = Lokasi::all();
        return response()->json($lokasi);
    }
}
