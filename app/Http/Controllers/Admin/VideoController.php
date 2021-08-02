<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Video;
use App\Models\Lokasi;
use App\Models\Rempah;
use App\Models\KategoriShow;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();

        return view('admin.content.video.index', compact('videos'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();

        return view('admin.content.video.add', compact('rempahs', 'lokasi', 'kategori_show'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'id_lokasi' => 'required',
            'youtube_key' => 'required'
        ]);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = 'assets/video/slider';
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);
        } else {
            $filename_slider = null;
        }

        $video = Video::create([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => $request->contributor != null ? 'Kontributor Umum/Pamong' : 'Admin',
            'youtube_key' => $request->youtube_key,
            'slider_file' => $filename_slider,
            'contributor' => $request->contributor,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        // ATTACH REMPAH VIDEO
        $video->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW VIDEO
        $video->kategori_show()->attach($request->kategori_show);

        return redirect()->route('admin.video.index');
    }

    public function edit($videoId)
    {
        $video = Video::findOrFail($videoId);
        $lokasi = Lokasi::all();
        $rempahs = Rempah::all();
        $kategori_show = KategoriShow::all();

        return view('admin.content.video.edit', compact('video', 'lokasi', 'kategori_show', 'rempahs'));
    }

    public function update(Request $request, $videoId) 
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'id_lokasi' => 'required',
            'youtube_key' => 'required' 
        ]);

        $video = Video::findOrFail($videoId);
    

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = 'assets/video/slider';
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);

            File::delete('assets/video/slider/' . $video->slider_file);            
        } else {
            $filename_slider = $video->slider_file;
        }
        
        $video->update([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => $request->contributor != null ? 'Kontributor Umum/Pamong' : 'Admin',
            'slider_file' => $filename_slider,
            'youtube_key' => $request->youtube_key,
            'slider_utama' => $request->slider_utama != null ? true : false,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        // SYNC REMPAH VIDEO
        $video->rempahs()->sync($request->rempah);

        // SYNC KATEGORI SHOW VIDEO
        $video->kategori_show()->sync($request->kategori_show);

        return redirect()->route('admin.video.index');
    }

    public function delete($videoId)
    {
        $video = Video::findOrFail($videoId);
        $video->delete();

        return redirect()->route('admin.video.index');
    }
}
