<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    public function index()
    {
        return view('admin.content.photo.index');
    }

    public function add() 
    {
        return view('admin.content.photo.add');
    }

    public function edit()
    {
        return view('admin.content.photo.edit');
    }
}
