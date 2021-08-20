<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Artikel;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;
use App\Models\Kontributor;

use Alert;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::orderBy('created_at', 'desc')->get();

        return view('admin.content.article.index', compact('artikels'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();
        $kontributor = Kontributor::all();

        return view('admin.content.article.add', compact('rempahs', 'lokasi', 'kategori_show', 'kontributor'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
        ]);

        // UPLOAD THUMBNAIL
        $thumbnail = $request->file('thumbnail');
        $tujuan_upload_file_thumbnail = storage_path('app/public/assets/artikel/thumbnail');
        $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move($tujuan_upload_file_thumbnail, $filename_thumbnail);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = storage_path('app/public/assets/artikel/slider');
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);
        } else {
            $filename_slider = null;
        }

        $slug_english = null;
        if( $request->judul_english )
            $slug_english = generate_slug($request->judul_english, '-');

        $artikel = Artikel::create([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'meta_indo' => $request->meta_indo,
            'keywords_indo' => $request->keywords_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'meta_english' => $request->meta_english,
            'keywords_english' => $request->keywords_english,
            'thumbnail' => $filename_thumbnail,
            'slug_english' => $slug_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => ($request->contributor != null && $request->id_kontributor != null) ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => ($request->contributor != null && $request->id_kontributor != null) ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        // ATTACH REMPAH ARTIKEL
        $artikel->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW ARTIKEL
        $artikel->kategori_show()->attach($request->kategori_show);

        Alert::success('Berhasil', 'Artikel berhasil ditambahkan');

        return redirect()->route('admin.article.index');

    }

    public function edit($articleId)
    {
        $artikel = Artikel::findOrFail($articleId);
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();
        $kontributor = Kontributor::all();

        return view('admin.content.article.edit', compact('artikel', 'rempahs', 'lokasi', 'kategori_show', 'kontributor'));
    }

    public function update(Request $request, $articleId)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
        ]);

        $artikel = Artikel::findOrFail($articleId);
        if( $request->has('thumbnail') ) {
            $this->validate($request, [
                'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            ]);

            $thumbnail = $request->file('thumbnail');
            $tujuan_upload_file = storage_path('app/public/assets/artikel/thumbnail');
            $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($tujuan_upload_file, $filename_thumbnail);

            // unlink(storage_path('app/public/assets/artikel/thumbnail') . $artikel->thumbnail );
            File::delete(storage_path('app/public/assets/artikel/thumbnail', $artikel->thumbnail));
        } else {
            $filename_thumbnail = $artikel->thumbnail;
        }

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = storage_path('app/public/assets/artikel/slider');
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);

            File::delete(storage_path('app/public/assets/artikel/slider', $artikel->slider_file));            
        } else {
            $filename_slider = $artikel->slider_file;
        }

        $slug_english = null;
        if( !$artikel->slug_english ) {
            $slug_english = generate_slug($request->judul_english, '-');
        }

        $artikel->update([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'keywords_indo' => $request->keywords_indo,
            'meta_indo' => $request->meta_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'keywords_english' => $request->keywords_english,
            'meta_english' => $request->meta_english,
            'thumbnail' => $filename_thumbnail,
            'slug_english' => $slug_english == null ? $artikel->slug_english : $slug_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => $request->contributor != null && $request->id_kontributor != null ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => $request->contributor != null && $request->id_kontributor != null ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        $artikel->rempahs()->sync($request->rempah);

        $artikel->kategori_show()->sync($request->kategori_show);

        Alert::success('Berhasil', 'Artikel berhasil diedit');

        return redirect()->route('admin.article.index');
    }

    public function delete($articleId)
    {
        $artikel = Artikel::findOrFail($articleId);

        if( $artikel->slider_file != null )
            File::delete(storage_path('app/public/assets/artikel/slider', $artikel->slider_file));   

        File::delete(storage_path('app/public/assets/artikel/thumbnail', $artikel->thumbnail));
        $artikel->delete();   

        return redirect()->route('admin.article.index');
    }

}
