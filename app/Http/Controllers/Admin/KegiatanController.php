<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kegiatan;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::all();

        return view('admin.informasi.kegiatan.index', compact('kegiatan'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();

        return view('admin.informasi.kegiatan.add', compact('rempahs', 'lokasi', 'kategori_show'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'meta_indo' => 'required',
            'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
        ]);

        // UPLOAD THUMBNAIL
        $thumbnail = $request->file('thumbnail');
        $tujuan_upload_file_thumbnail = storage_path('app/public/assets/kegiatan/thumbnail');
        $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move($tujuan_upload_file_thumbnail, $filename_thumbnail);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = storage_path('app/public/assets/kegiatan/slider', $kegiatan->slider_file);
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);
        } else {
            $filename_slider = null;
        }

        $kegiatan = Kegiatan::create([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'meta_indo' => $request->meta_indo,
            'keywords_indo' => $request->keywords_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'meta_english' => $request->meta_english,
            'keywords_english' => $request->keywords_english, 
            'thumbnail' => $filename_thumbnail,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => $request->contributor != null ? 'kontributor umum/pamong budaya' : 'admin',
            'slider_file' => $filename_slider,
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        // ATTACH REMPAH ARTIKEL
        $kegiatan->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW ARTIKEL
        $kegiatan->kategori_show()->attach($request->kategori_show);

        return redirect()->route('admin.kegiatan.index');

    }

    public function edit($kegiatanId)
    {
        $kegiatan = Kegiatan::findOrFail($kegiatanId);
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();

        return view('admin.informasi.kegiatan.edit', compact('kegiatan', 'rempahs', 'lokasi', 'kategori_show'));
    }

    public function update(Request $request, $kegiatanId)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
        ]);

        $kegiatan = Kegiatan::findOrFail($kegiatanId);
        if( $request->has('thumbnail') ) {
            $this->validate($request, [
                'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            ]);

            $thumbnail = $request->file('thumbnail');
            $tujuan_upload_file = storage_path('app/public/assets/kegiatan/thumbnail', $kegiatan->thumbnail);
            $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($tujuan_upload_file, $filename_thumbnail);

            // unlink('assets/kegiatan/thumbnail/' . $kegiatan->thumbnail );
            File::delete(storage_path('app/public/assets/kegiatan/thumbnail', $kegiatan->thumbnail));
        } else {
            $filename_thumbnail = $kegiatan->thumbnail;
        }

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = storage_path('app/public/assets/kegiatan/slider');
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);

            File::delete(storage_path('app/public/assets/kegiatan/slider', $kegiatan->slider_file));            
        } else {
            $filename_slider = $kegiatan->slider_file;
        }

        $kegiatan->update([
            'meta_indo' => $request->meta_indo,
            'keywords_indo' => $request->keywords_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'meta_english' => $request->meta_english,
            'keywords_english' => $request->keywords_english, 
            'thumbnail' => $filename_thumbnail,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => $request->contributor != null ? 'kontributor umum/pamong budaya' : 'admin',
            'slider_file' => $filename_slider,
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        $kegiatan->rempahs()->sync($request->rempah);

        $kegiatan->kategori_show()->sync($request->kategori_show);

        return redirect()->route('admin.kegiatan.index');
    }

    public function delete($kegiatanId)
    {
        $kegiatan = Kegiatan::findOrFail($kegiatanId);

        if( $kegiatan->slider_file != null )
            File::delete(storage_path('app/public/assets/kegiatan/slider', $kegiatan->slider_file));   

        File::delete(storage_path('app/public/assets/kegiatan/thumbnail', $kegiatan->thumbnail));
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index');
    }
}
