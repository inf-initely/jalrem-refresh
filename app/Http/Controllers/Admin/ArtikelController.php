<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Artikel;
use App\Models\Rempah;
use App\Models\Lokasi;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::all();

        return view('admin.content.article.index', compact('artikels'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();

        return view('admin.content.article.add', compact('rempahs', 'lokasi'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            'id_lokasi' => 'required',
            'rempah' => 'required'
        ]);

        $thumbnail = $request->file('thumbnail');
        $tujuan_upload_file = 'assets/artikel/thumbnail';
        $filename = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move($tujuan_upload_file, $filename);

        $artikel = Artikel::create([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'thumbnail' => $filename,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => 'admin',
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        $artikel->rempahs()->attach($request->rempah);

        return redirect()->route('admin.article.index');

    }

    public function edit($articleId)
    {
        $artikel = Artikel::findOrFail($articleId);
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();

        return view('admin.content.article.edit', compact('artikel', 'rempahs', 'lokasi'));
    }

    public function update(Request $request, $articleId)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'id_lokasi' => 'required',
            'rempah' => 'required'
        ]);

        $artikel = Artikel::findOrFail($articleId);
        if( $request->has('thumbnail') ) {
            $this->validate($request, [
                'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            ]);

            $thumbnail = $request->file('thumbnail');
            $tujuan_upload_file = 'assets/artikel/thumbnail';
            $filename = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($tujuan_upload_file, $filename);

            // unlink('assets/artikel/thumbnail/' . $artikel->thumbnail );
            File::delete('assets/artikel/thumbnail/' . $artikel->thumbnail);
        } else {
            $filename = $artikel->thumbnail;
        }

        $artikel->update([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'thumbnail' => $filename,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => 'admin',
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        $artikel->rempahs()->sync($request->rempah);

        return redirect()->route('admin.article.index');
    }
}
