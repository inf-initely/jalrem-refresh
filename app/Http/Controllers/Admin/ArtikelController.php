<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        return view('admin.content.article.index');
    }
}
