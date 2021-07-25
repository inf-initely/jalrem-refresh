<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        return view('admin.content.article.index');
    }

    public function add() 
    {
        return view('admin.content.article.add');
    }

    public function edit()
    {
        return view('admin.content.article.edit');
    }
}
