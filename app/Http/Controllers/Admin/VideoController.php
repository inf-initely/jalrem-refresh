<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return view('admin.content.video.index');
    }

    public function add() 
    {
        return view('admin.content.video.add');
    }

    public function edit()
    {
        return view('admin.content.video.edit');
    }
}
