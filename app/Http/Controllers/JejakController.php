<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JejakController extends Controller
{
    public function index()
    {
        return view('content.tentang_jejak');
    }
}
