<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Audio;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;

class AudioController extends Controller
{
    public function index()
    {
        $audio = Audio::all();
        
        return view('admin.content.audio.index', compact('audio'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();

        return view('admin.content.audio.add', compact('rempahs', 'lokasi', 'kategori_show'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'id_lokasi' => 'required',
            'cloud_key' => 'required'
        ]);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = 'assets/audio/slider';
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);
        } else {
            $filename_slider = null;
        }

        $audio = Audio::create([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => $request->contributor != null ? 'Kontributor Umum/Pamong' : 'Admin',
            'cloud_key' => $request->cloud_key,
            'slider_file' => $filename_slider,
            'contributor' => $request->contributor,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        // ATTACH REMPAH Audio
        $audio->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW Audio
        $audio->kategori_show()->attach($request->kategori_show);

        return redirect()->route('admin.audio.index');
    }

    public function edit($audioId)
    {
        $audio = Audio::findOrFail($audioId);
        $lokasi = Lokasi::all();
        $rempahs = Rempah::all();
        $kategori_show = KategoriShow::all();

        return view('admin.content.audio.edit', compact('audio', 'lokasi', 'kategori_show', 'rempahs'));
    }

    public function update(Request $request, $audioId) 
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'id_lokasi' => 'required',
            'cloud_key' => 'required'
        ]);

        $audio = Audio::findOrFail($audioId);
    

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = 'assets/audio/slider';
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);

            File::delete('assets/audio/slider/' . $audio->slider_file);            
        } else {
            $filename_slider = $audio->slider_file;
        }
        
        $audio->update([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => $request->contributor != null ? 'Kontributor Umum/Pamong' : 'Admin',
            'slider_file' => $filename_slider,
            'cloud_key' => $request->cloud_key,
            'slider_utama' => $request->slider_utama != null ? true : false,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        // SYNC REMPAH Audio
        $audio->rempahs()->sync($request->rempah);

        // SYNC KATEGORI SHOW Audio
        $audio->kategori_show()->sync($request->kategori_show);

        return redirect()->route('admin.audio.index');
    }
}
