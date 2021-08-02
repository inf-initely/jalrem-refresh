<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Publikasi;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;

class PublikasiController extends Controller
{
    public function index()
    {
        $publikasi = Publikasi::all();

        return view('admin.content.publication.index', compact('publikasi'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();

        return view('admin.content.publication.add', compact('rempahs', 'lokasi', 'kategori_show'));
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
        $tujuan_upload_file_thumbnail = 'assets/publikasi/thumbnail';
        $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move($tujuan_upload_file_thumbnail, $filename_thumbnail);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = 'assets/publikasi/slider';
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);
        } else {
            $filename_slider = null;
        }

        $publikasi = Publikasi::create([
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
        $publikasi->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW ARTIKEL
        $publikasi->kategori_show()->attach($request->kategori_show);

        return redirect()->route('admin.publication.index');

    }

    public function edit($publicationId)
    {
        $publikasi = Publikasi::findOrFail($publicationId);
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();

        return view('admin.content.publication.edit', compact('publikasi', 'rempahs', 'lokasi', 'kategori_show'));
    }

    public function update(Request $request, $articleId)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'id_lokasi' => 'required',
        ]);

        $publikasi = Publikasi::findOrFail($articleId);
        if( $request->has('thumbnail') ) {
            $this->validate($request, [
                'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            ]);

            $thumbnail = $request->file('thumbnail');
            $tujuan_upload_file = 'assets/publikasi/thumbnail';
            $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($tujuan_upload_file, $filename_thumbnail);

            // unlink('assets/publikasi/thumbnail/' . $publikasi->thumbnail );
            File::delete('assets/publikasi/thumbnail/' . $publikasi->thumbnail);
        } else {
            $filename_thumbnail = $publikasi->thumbnail;
        }

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = 'assets/publikasi/slider';
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);

            File::delete('assets/publikasi/slider/' . $publikasi->slider_file);            
        } else {
            $filename_slider = $publikasi->slider_file;
        }

        $publikasi->update([
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

        $publikasi->rempahs()->sync($request->rempah);

        $publikasi->kategori_show()->sync($request->kategori_show);

        return redirect()->route('admin.publication.index');
    }

    public function delete($publicationId)
    {
        $publikasi = Publikasi::findOrFail($publicationId);
        $publikasi->delete();

        return redirect()->route('admin.publication.index');
    }


}
