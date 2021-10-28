<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Kegiatan;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;
use App\Models\Kontributor;

use Alert;
use Carbon\Carbon;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::orderBy('created_at', 'desc')->get();

        return view('admin.informasi.kegiatan.index', compact('kegiatan'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
        $kontributor = Kontributor::all();

        return view('admin.informasi.kegiatan.add', compact('rempahs', 'lokasi', 'kategori_show', 'kontributor'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            'end_date' => 'required'
        ]);

        // UPLOAD THUMBNAIL
        $thumbnail = $request->file('thumbnail');
        $filename_thumbnail = upload_file('app/public/assets/kegiatan/thumbnail', $thumbnail);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/kegiatan/slider', $slider);
        } else {
            $filename_slider = null;
        }

        $slug_english = null;
        if( $request->judul_english )
            $slug_english = generate_slug($request->judul_english, '-');

        
        // SET END DATE
        $end_date = explode('-', $request->end_date);
        $tanggal = $end_date[2];
        $bulan = $end_date[1];
        $tahun = $end_date[0];
        $end_date_timestamp = Carbon::create($tahun, $bulan, $tanggal, 0)->toDateTimeString();

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
            'end_date' => $end_date_timestamp,
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
        $kegiatan->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW ARTIKEL
        $kegiatan->kategori_show()->attach($request->kategori_show);

        Alert::success('Berhasil', 'Kegiatan berhasil ditambahkan');

        return redirect()->route('admin.kegiatan.index');

    }

    public function edit($kegiatanId)
    {
        $kegiatan = Kegiatan::findOrFail($kegiatanId);
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
        $kontributor = Kontributor::all();

        return view('admin.informasi.kegiatan.edit', compact('kegiatan', 'rempahs', 'lokasi', 'kategori_show', 'kontributor'));
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
            $filename_thumbnail = upload_file('app/public/assets/kegiatan/thumbnail', $thumbnail);

            // unlink('assets/kegiatan/thumbnail/' . $kegiatan->thumbnail );
            File::delete(storage_path('app/public/assets/kegiatan/thumbnail', $kegiatan->thumbnail));
        } else {
            $filename_thumbnail = $kegiatan->thumbnail;
        }

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/kegiatan/slider', $slider);

            File::delete(storage_path('app/public/assets/kegiatan/slider', $kegiatan->slider_file));            
        } else {
            $filename_slider = $kegiatan->slider_file;
        }

        $slug_english = null;
        if( !$kegiatan->slug_english ) {
            $slug_english = generate_slug($request->judul_english, '-');
        }

        // SET END DATE
        $end_date = explode('-', $request->end_date);
        $tanggal = $end_date[2];
        $bulan = $end_date[1];
        $tahun = $end_date[0];
        $end_date_timestamp = Carbon::create($tahun, $bulan, $tanggal, 0)->toDateTimeString();

        $kegiatan->update([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'meta_indo' => $request->meta_indo,
            'keywords_indo' => $request->keywords_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'meta_english' => $request->meta_english,
            'keywords_english' => $request->keywords_english, 
            'thumbnail' => $filename_thumbnail,
            'end_date' => $end_date_timestamp,
            'slug_english' => $slug_english == null ? $kegiatan->slug_english : $slug_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => ($request->contributor != null && $request->id_kontributor != null) ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => ($request->contributor != null && $request->id_kontributor != null) ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft',
            'published_at' => $request->publish_date . " " . $request->publish_time
        ]);

        $kegiatan->rempahs()->sync($request->rempah);

        $kegiatan->kategori_show()->sync($request->kategori_show);
        
        Alert::success('Berhasil', 'Kegiatan berhasil diedit');

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
