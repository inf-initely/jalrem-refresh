<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JalurController extends Controller
{
    public function index()
    {
        return view('content.tentang_jalur');
    }
}
