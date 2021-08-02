<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Artikel;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;

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
        $kategori_show = KategoriShow::all();

        return view('admin.content.article.add', compact('rempahs', 'lokasi', 'kategori_show'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            'id_lokasi' => 'required',
        ]);

        // UPLOAD THUMBNAIL
        $thumbnail = $request->file('thumbnail');
        $tujuan_upload_file_thumbnail = 'assets/artikel/thumbnail';
        $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move($tujuan_upload_file_thumbnail, $filename_thumbnail);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = 'assets/artikel/slider';
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);
        } else {
            $filename_slider = null;
        }

        $artikel = Artikel::create([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'thumbnail' => $filename_thumbnail,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => $request->contributor != null ? 'Kontributor Umum/Pamong' : 'Admin',
            'slider_file' => $filename_slider,
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        // ATTACH REMPAH ARTIKEL
        $artikel->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW ARTIKEL
        $artikel->kategori_show()->attach($request->kategori_show);

        return redirect()->route('admin.article.index');

    }

    public function edit($articleId)
    {
        $artikel = Artikel::findOrFail($articleId);
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();

        return view('admin.content.article.edit', compact('artikel', 'rempahs', 'lokasi', 'kategori_show'));
    }

    public function update(Request $request, $articleId)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'id_lokasi' => 'required',
        ]);

        $artikel = Artikel::findOrFail($articleId);
        if( $request->has('thumbnail') ) {
            $this->validate($request, [
                'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            ]);

            $thumbnail = $request->file('thumbnail');
            $tujuan_upload_file = 'assets/artikel/thumbnail';
            $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($tujuan_upload_file, $filename_thumbnail);

            // unlink('assets/artikel/thumbnail/' . $artikel->thumbnail );
            File::delete('assets/artikel/thumbnail/' . $artikel->thumbnail);
        } else {
            $filename_thumbnail = $artikel->thumbnail;
        }

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = 'assets/artikel/slider';
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);

            File::delete('assets/artikel/slider/' . $artikel->slider_file);            
        } else {
            $filename_slider = $artikel->slider_file;
        }

        $artikel->update([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'thumbnail' => $filename_thumbnail,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => $request->contributor != null ? 'Kontributor Umum/Pamong' : 'Admin',
            'slider_file' => $filename_slider,
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        $artikel->rempahs()->sync($request->rempah);

        $artikel->kategori_show()->sync($request->kategori_show);

        return redirect()->route('admin.article.index');
    }

    public function delete($articleId)
    {
        $artikel = Artikel::findOrFail($articleId);
        $artikel->delete();

        return redirect()->route('admin.article.index');
    }
}
