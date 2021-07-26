<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function show()
    {
        return view('content.event_detail');
    }
}
