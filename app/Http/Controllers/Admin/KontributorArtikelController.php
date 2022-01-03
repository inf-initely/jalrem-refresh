<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Artikel;

class KontributorArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::where('id_kontributor', '!=', null)->orderBy('created_at', 'desc')->get();

        return view('admin.contributor_article.index', compact('artikel'));
    }
}
