<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function index()
    {
        return view('admin.content.publication.index');
    }

    public function add() 
    {
        return view('admin.content.publication.add');
    }

    public function edit()
    {
        return view('admin.content.publication.edit');
    }
}
