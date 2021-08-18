<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Rempah;

class RempahController extends Controller
{
    public function show($rempahId)
    {
        $rempah = Rempah::findOrFail($rempahId);

        return view('content.rempah_detail', $rempah);
    }
}
