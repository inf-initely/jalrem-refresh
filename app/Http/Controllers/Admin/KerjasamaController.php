<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Kerjasama;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;
use App\Models\Kontributor;

class KerjasamaController extends Controller
{
    public function index()
    {
        $kerjasama = Kerjasama::all();

        return view('admin.informasi.kerjasama.index', compact('kerjasama'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();
        $kontributor = Kontributor::all();

        return view('admin.informasi.kerjasama.add', compact('rempahs', 'lokasi', 'kategori_show', 'kontributor'));
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
        $tujuan_upload_file_thumbnail = storage_path('app/public/assets/kerjasama/thumbnail');
        $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move($tujuan_upload_file_thumbnail, $filename_thumbnail);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = storage_path('app/public/assets/kerjasama/slider');
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);
        } else {
            $filename_slider = null;
        }

        $kerjasama = Kerjasama::create([
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
            'penulis' => ($request->contributor != null && $request->id_kontributor != null) ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => ($request->contributor != null && $request->id_kontributor != null) ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        // ATTACH REMPAH ARTIKEL
        $kerjasama->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW ARTIKEL
        $kerjasama->kategori_show()->attach($request->kategori_show);

        return redirect()->route('admin.kerjasama.index');

    }

    public function edit($kerjasamaId)
    {
        $kerjasama = Kerjasama::findOrFail($kerjasamaId);
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();
        $kontributor = Kontributor::all();

        return view('admin.informasi.kerjasama.edit', compact('kerjasama', 'rempahs', 'lokasi', 'kategori_show', 'kontributor'));
    }

    public function update(Request $request, $kerjasamaId)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
        ]);

        $kerjasama = Kerjasama::findOrFail($kerjasamaId);
        if( $request->has('thumbnail') ) {
            $this->validate($request, [
                'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            ]);

            $thumbnail = $request->file('thumbnail');
            $tujuan_upload_file = storage_path('app/public/assets/kerjasama/thumbnail', $kerjasama->thumbnail);
            $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($tujuan_upload_file, $filename_thumbnail);

            // unlink('assets/kerjasama/thumbnail/' . $kerjasama->thumbnail );
            File::delete(storage_path('app/public/assets/kerjasama/thumbnail', $kerjasama->thumbnail));
        } else {
            $filename_thumbnail = $kerjasama->thumbnail;
        }

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = storage_path('app/public/assets/kerjasama/slider');
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);

            File::delete(storage_path('app/public/assets/kegiatan/slider', $kegiatan->slider_file));            
        } else {
            $filename_slider = $kerjasama->slider_file;
        }

        $kerjasama->update([
            'meta_indo' => $request->meta_indo,
            'keywords_indo' => $request->keywords_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'meta_english' => $request->meta_english,
            'keywords_english' => $request->keywords_english, 
            'thumbnail' => $filename_thumbnail,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => ($request->contributor != null && $request->id_kontributor != null) ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => ($request->contributor != null && $request->id_kontributor != null) ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        $kerjasama->rempahs()->sync($request->rempah);

        $kerjasama->kategori_show()->sync($request->kategori_show);

        return redirect()->route('admin.kerjasama.index');
    }

    public function delete($kerjasamaId)
    {
        $kerjasama = Kerjasama::findOrFail($kerjasamaId);
        if( $kerjasama->slider_file != null )
            File::delete(storage_path('app/public/assets/kerjasama/slider', $kerjasama->slider_file));   

        File::delete(storage_path('app/public/assets/kerjasama/thumbnail', $kerjasama->thumbnail));
        
        $kerjasama->delete();

        return redirect()->route('admin.kerjasama.index');
    }
}
