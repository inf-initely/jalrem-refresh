<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Publikasi;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;
use App\Models\Kontributor;

use Alert;

class PublikasiController extends Controller
{
    public function index()
    {
        $publikasi = Publikasi::orderBy('created_at', 'desc')->get();

        return view('admin.content.publication.index', compact('publikasi'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
        $kontributor = Kontributor::all();

        return view('admin.content.publication.add', compact('rempahs', 'lokasi', 'kategori_show', 'kontributor'));
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
        $filename_thumbnail = upload_file('app/public/assets/publikasi/thumbnail', $thumbnail);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/publikasi/slider', $slider);
        } else {
            $filename_slider = null;
        }

        $slug_english = ( $request->judul_english )
            ? generate_slug($request->judul_english, '-')
            : null;
            
        $publikasi = Publikasi::create([
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
            'iframe' => $request->iframe,
            'status' => $request->publish != null ? 'publikasi' : 'draft',
            'published_at' => $request->publish_date . " " . $request->publish_time
        ]);

        // ATTACH REMPAH ARTIKEL
        $publikasi->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW ARTIKEL
        $publikasi->kategori_show()->attach($request->kategori_show);

        Alert::success('Berhasil', 'Publikasi berhasil ditambah');

        return redirect()->route('admin.publication.index');

    }

    public function edit($publicationId)
    {
        $publikasi = Publikasi::findOrFail($publicationId);
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
        $kontributor = Kontributor::all();

        return view('admin.content.publication.edit', compact('publikasi', 'rempahs', 'lokasi', 'kategori_show', 'kontributor'));
    }

    public function update(Request $request, $articleId)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
        ]);

        $publikasi = Publikasi::findOrFail($articleId);
        if( $request->has('thumbnail') ) {
            $this->validate($request, [
                'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            ]);

            $thumbnail = $request->file('thumbnail');
            $filename_thumbnail = upload_file('app/public/assets/publikasi/thumbnail', $thumbnail);

            // unlink('assets/publikasi/thumbnail/' . $publikasi->thumbnail );
            File::delete(storage_path('app/public/assets/kerjasama/thumbnail', $publikasi->thumbnail));
        } else {
            $filename_thumbnail = $publikasi->thumbnail;
        }

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/publikasi/slider', $slider);

            File::delete(storage_path('app/public/assets/publikasi/slider', $publikasi->slider_file));            
        } else {
            $filename_slider = $publikasi->slider_file;
        }

        $slug_english = null;
        if( !$publikasi->slug_english ) {
            $slug_english = generate_slug($request->judul_english, '-');
        }

        $publikasi->update([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'meta_indo' => $request->meta_indo,
            'keywords_indo' => $request->keywords_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'meta_english' => $request->meta_english,
            'keywords_english' => $request->keywords_english,
            'thumbnail' => $filename_thumbnail,
            'slug_english' => $slug_english == null ? $publikasi->slug_english : $slug_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => ($request->contributor != null && $request->id_kontributor != null) ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => ($request->contributor != null && $request->id_kontributor != null) ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'iframe' => $request->iframe,
            'status' => $request->publish != null ? 'publikasi' : 'draft',
            'published_at' => $request->publish_date . " " . $request->publish_time
        ]);

        $publikasi->rempahs()->sync($request->rempah);

        $publikasi->kategori_show()->sync($request->kategori_show);

        Alert::success('Berhasil', 'Publikasi berhasil diedit');

        return redirect()->route('admin.publication.index');
    }

    public function delete($publicationId)
    {
        $publikasi = Publikasi::findOrFail($publicationId);
        if( $publikasi->slider_file != null )
            File::delete(storage_path('app/public/assets/publikasi/slider', $publikasi->slider_file));   

        File::delete(storage_path('app/public/assets/publikasi/thumbnail', $publikasi->thumbnail));
        $publikasi->delete();

        return redirect()->route('admin.publication.index');
    }


}
