<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuaraController extends Controller
{
    public function index()
    {
        return view('admin.content.sound.index');
    }

    public function add() 
    {
        return view('admin.content.sound.add');
    }

    public function edit()
    {
        return view('admin.content.sound.edit');
    }
}
