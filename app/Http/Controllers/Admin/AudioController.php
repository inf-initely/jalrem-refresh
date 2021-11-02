<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Audio;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;
use App\Models\Kontributor;

use Alert;

class AudioController extends Controller
{
    public function index()
    {
        $audio = Audio::orderBy('created_at', 'desc')->get();
        
        return view('admin.content.audio.index', compact('audio'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
        $kontributor = Kontributor::all();

        return view('admin.content.audio.add', compact('rempahs', 'lokasi', 'kategori_show', 'kontributor'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'cloud_key' => 'required|max:50|string'
        ]);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/audio/slider', $slider);
        } else {
            $filename_slider = null;
        }
        
        $slug_english = ( $request->judul_english )
            ? generate_slug($request->judul_english, '-')
            : null;
        $audio = Audio::create([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'meta_indo' => $request->meta_indo,
            'keywords_indo' => $request->keywords_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'meta_english' => $request->meta_english,
            'keywords_english' => $request->keywords_english,
            'id_lokasi' => $request->id_lokasi,
            'slug_english' => $slug_english,
            'penulis' => ($request->contributor != null && $request->id_kontributor != null) ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => ($request->contributor != null && $request->id_kontributor != null) ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'cloud_key' => $request->cloud_key,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft',
            'published_at' => $request->publish_date . " " . $request->publish_time
        ]);

        // ATTACH REMPAH Audio
        $audio->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW Audio
        $audio->kategori_show()->attach($request->kategori_show);

        Alert::success('Berhasil', 'Audio berhasil ditambahkan');

        return redirect()->route('admin.audio.index');
    }

    public function edit($audioId)
    {
        $audio = Audio::findOrFail($audioId);
        $lokasi = Lokasi::all();
        $rempahs = Rempah::all();
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
        $kontributor = Kontributor::all();

        return view('admin.content.audio.edit', compact('audio', 'lokasi', 'kategori_show', 'rempahs', 'kontributor'));
    }

    public function update(Request $request, $audioId) 
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'cloud_key' => 'required|max:50|string'
        ]);

        $audio = Audio::findOrFail($audioId);
    

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/audio/slider', $slider);

            File::delete(storage_path('app/public/assets/audio/slider', $audio->slider_file));            
        } else {
            $filename_slider = $audio->slider_file;
        }

        
        $slug_english = ( !$audio->slug_english )
            ? generate_slug($request->judul_english, '-')
            : null;

        $audio->update([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'meta_indo' => $request->meta_indo,
            'keywords_indo' => $request->keywords_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'meta_english' => $request->meta_english,
            'keywords_english' => $request->keywords_english,
            'slug_english' => $slug_english == null ? $audio->slug_english : $slug_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => ($request->contributor != null && $request->id_kontributor != null) ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => ($request->contributor != null && $request->id_kontributor != null) ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'cloud_key' => $request->cloud_key,
            'slider_utama' => $request->slider_utama != null ? true : false,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft',
            'published_at' => $request->publish_date . " " . $request->publish_time
        ]);

        // SYNC REMPAH Audio
        $audio->rempahs()->sync($request->rempah);

        // SYNC KATEGORI SHOW Audio
        $audio->kategori_show()->sync($request->kategori_show);

        Alert::success('Berhasil', 'Audio berhasil diedit');

        return redirect()->route('admin.audio.index');
    }

    public function delete($audioId)
    {
        $audio = Audio::findOrFail($audioId);

        if( $audio->slider_file != null )
            File::delete(storage_path('app/public/assets/audio/slider', $audio->slider_file));   
            
        File::delete(storage_path('app/public/assets/audio/thumbnail', $audio->thumbnail));
        $audio->delete();

        return redirect()->route('admin.audio.index');
    }
}
