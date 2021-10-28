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

use App\Http\Requests\ContentRequest;
use RealRashid\SweetAlert\Facades\Alert;

// use Alert;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::where('id_kontributor', null)->orderBy('created_at', 'desc')->get();

        return view('admin.content.article.index', compact('artikels'));
    }

    public function add()
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
        $kontributor = Kontributor::all();

        return view('admin.content.article.add', compact('rempahs', 'lokasi', 'kategori_show', 'kontributor'));
    }

    public function store(Request $request)
    {
        // UPLOAD THUMBNAIL
        $thumbnail = $request->file('thumbnail');
        $filename_thumbnail = upload_file('app/public/assets/artikel/thumbnail', $thumbnail);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/artikel/slider', $slider);
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
            'status' => $request->publish != null ? 'publikasi' : 'draft',
            'published_at' => $request->publish_date . " " . $request->publish_time
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
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
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
            $filename_thumbnail = upload_file('app/public/assets/artikel/thumbnail', $thumbnail);

            File::delete(storage_path('app/public/assets/artikel/thumbnail', $artikel->thumbnail));
        } else {
            $filename_thumbnail = $artikel->thumbnail;
        }

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/artikel/slider', $slider);

            File::delete(storage_path('app/public/assets/artikel/slider', $artikel->slider_file));
        } else {
            $filename_slider = $artikel->slider_file;
        }

        $slug_english = null;
        if( !$artikel->slug_english )
            $slug_english = generate_slug($request->judul_english, '-');

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
            'status' => $request->publish != null ? 'publikasi' : 'draft',
            'published_at' => $request->publish_date . " " . $request->publish_time
        ]);

        $artikel->rempahs()->sync($request->rempah);

        $artikel->kategori_show()->sync($request->kategori_show);
        Alert::success('Berhasil', 'Artikel berhasil diedit');
        
        if( $artikel->id_kontributor == null ) {
            return redirect()->route('admin.article.index');
        }
        return redirect()->route('admin.contributor_article.index');
    }

    public function delete($articleId)
    {
        $artikel = Artikel::findOrFail($articleId);
        $artikel_kontributor = false;
        if( $artikel->id_kontributor != null ) {
            $artikel_kontributor = true;
        }

        if( $artikel->slider_file != null )
            File::delete(storage_path('app/public/assets/artikel/slider', $artikel->slider_file));

        File::delete(storage_path('app/public/assets/artikel/thumbnail', $artikel->thumbnail));
        $artikel->delete();

        if( $artikel_kontributor ) {
            return redirect()->route('admin.contributor_article.index');   
        }
        return redirect()->route('admin.article.index');
    }

}
