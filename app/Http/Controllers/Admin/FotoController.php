<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Foto;

class FotoController extends Controller
{
    public function index()
    {
        $foto = Foto::all();
        return view('admin.content.photo.index', compact('foto'));
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
