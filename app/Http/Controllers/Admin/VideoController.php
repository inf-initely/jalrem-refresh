<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Video;
use App\Models\Lokasi;
use App\Models\Rempah;
use App\Models\KategoriShow;
use App\Models\Kontributor;

use Alert;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('created_at', 'desc')->get();

        return view('admin.content.video.index', compact('videos'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
        $kontributor = Kontributor::all();

        return view('admin.content.video.add', compact('rempahs', 'lokasi', 'kategori_show', 'kontributor'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'youtube_key' => 'required|string|max:30'
        ]);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/video/slider', $slider);
        } else {
            $filename_slider = null;
        }

        $slug_english = ( $request->judul_english )
            ? $slug_english = generate_slug($request->judul_english, '-')
            : null;

        $video = Video::create([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'meta_indo' => $request->meta_indo,
            'keywords_indo' => $request->keywords_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'meta_english' => $request->meta_english,
            'keywords_english' => $request->keywords_english,
            'slug_english' => $slug_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => ($request->contributor != null && $request->id_kontributor != null) ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => ($request->contributor != null && $request->id_kontributor != null) ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'youtube_key' => $request->youtube_key,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft',
            'published_at' => $request->publish_date . " " . $request->publish_time
        ]);

        // ATTACH REMPAH VIDEO
        $video->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW VIDEO
        $video->kategori_show()->attach($request->kategori_show);

        Alert::success('Berhasil', 'Video berhasil ditambah');

        return redirect()->route('admin.video.index');
    }

    public function edit($videoId)
    {
        $video = Video::findOrFail($videoId);
        $lokasi = Lokasi::all();
        $rempahs = Rempah::all();
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
        $kontributor = Kontributor::all();

        return view('admin.content.video.edit', compact('video', 'lokasi', 'kategori_show', 'rempahs', 'kontributor'));
    }

    public function update(Request $request, $videoId) 
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'youtube_key' => 'required|string|max:30' 
        ]);

        $video = Video::findOrFail($videoId);
    

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/video/slider', $slider);

            File::delete(storage_path('app/public/assets/video/slider', $video->slider_file));            
        } else {
            $filename_slider = $video->slider_file;
        }

        $slug_english = ( !$video->slug_english )
            ? generate_slug($request->judul_english, '-')
            : null;
        
        $video->update([
            'judul_indo' => $request->judul_indo,
            'konten_indo' => $request->konten_indo,
            'meta_indo' => $request->meta_indo,
            'keywords_indo' => $request->keywords_indo,
            'judul_english' => $request->judul_english,
            'konten_english' => $request->konten_english,
            'meta_english' => $request->meta_english,
            'keywords_english' => $request->keywords_english,
            'slug_english' => $slug_english == null ? $video->slug_english : $slug_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => ($request->contributor != null && $request->id_kontributor != null) ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => ($request->contributor != null && $request->id_kontributor != null) ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'youtube_key' => $request->youtube_key,
            'slider_utama' => $request->slider_utama != null ? true : false,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft',
            'published_at' => $request->publish_date . " " . $request->publish_time
        ]);

        // SYNC REMPAH VIDEO
        $video->rempahs()->sync($request->rempah);

        // SYNC KATEGORI SHOW VIDEO
        $video->kategori_show()->sync($request->kategori_show);

        Alert::success('Berhasil', 'Video berhasil diedit');

        return redirect()->route('admin.video.index');
    }

    public function delete($videoId)
    {
        $video = Video::findOrFail($videoId);
        if( $video->slider_file != null )
            File::delete(storage_path('app/public/assets/video/slider', $video->slider_file));   

        File::delete(storage_path('app/public/assets/video/thumbnail', $video->thumbnail));
        $video->delete();

        return redirect()->route('admin.video.index');
    }
}
