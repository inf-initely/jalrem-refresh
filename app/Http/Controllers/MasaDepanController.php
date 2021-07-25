<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasaDepanController extends Controller
{
    public function index()
    {
        return view('content.tentang_masadepan');
    }
}
