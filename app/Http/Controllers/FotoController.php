<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FotoController extends Controller
{
    public function index()
    {
        return view('content.photos');
    }

    public function show()
    {
        return view('content.photo_detail');
    }
}
