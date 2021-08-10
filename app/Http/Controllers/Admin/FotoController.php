<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Foto;
use App\Models\Rempah;
use App\Models\KategoriShow;
use App\Models\Lokasi;


class FotoController extends Controller
{
    public function index()
    {
        $foto = Foto::all();
        return view('admin.content.photo.index', compact('foto'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();

        return view('admin.content.photo.add', compact('rempahs', 'lokasi', 'kategori_show'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
            'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            'slider_foto' => 'required'
        ]);

        // UPLOAD THUMBNAIL
        $thumbnail = $request->file('thumbnail');
        $tujuan_upload_file_thumbnail = storage_path('app/public/assets/foto/thumbnail');
        $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move($tujuan_upload_file_thumbnail, $filename_thumbnail);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = storage_path('app/public/assets/foto/slider');
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);
        } else {
            $filename_slider = null;
        }

        // UPLOAD SLIDER FOTO
        foreach( $request->file('slider_foto') as $slider_foto ) {
            $tujuan_upload_file_slider_foto = storage_path('app/public/assets/foto/slider_foto');;
            $filename_slider_foto = uniqid() . '.' . $slider_foto->getClientOriginalExtension();
            $slider_foto->move($tujuan_upload_file_slider_foto, $filename_slider_foto);
            $slider_foto_array[] = $filename_slider_foto;
        }

        $slider_foto_array = serialize($slider_foto_array);
        

        $foto = Foto::create([
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
            'slider_foto' => $slider_foto_array,
            'caption_slider_foto' => serialize($request->caption_slider_foto),
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);
        // ATTACH REMPAH FOTO
        $foto->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW FOTO
        $foto->kategori_show()->attach($request->kategori_show);

        return redirect()->route('admin.photo.index');
    }

    public function edit($photoId)
    {
        $foto = Foto::findOrFail($photoId);
        $lokasi = Lokasi::all();
        $rempahs = Rempah::all();
        $kategori_show = KategoriShow::all();

        return view('admin.content.photo.edit', compact('foto', 'lokasi', 'kategori_show', 'rempahs'));
    }

    public function update(Request $request, $photoId)
    {
        $this->validate($request, [
            'judul_indo' => 'required',
            'konten_indo' => 'required',
        ]);

        $foto = Foto::findOrFail($photoId);

        if( $request->has('thumbnail') ) {
            $this->validate($request, [
                'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            ]);
            // UPLOAD THUMBNAIL
            $thumbnail = $request->file('thumbnail');
            $tujuan_upload_file_thumbnail = storage_path('app/public/assets/foto/thumbnail');;
            $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move($tujuan_upload_file_thumbnail, $filename_thumbnail);

            File::delete(storage_path('app/public/assets/foto/thumbnail', $foto->thumbnail));
        } else {
            $filename_thumbnail = $foto->thumbnail;
        }
    

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $tujuan_upload_file_slider = storage_path('app/public/assets/foto/slider');;
            $filename_slider = uniqid() . '.' . $slider->getClientOriginalExtension();
            $slider->move($tujuan_upload_file_slider, $filename_slider);

            File::delete(storage_path('app/public/assets/foto/slider', $foto->slider));            
        } else {
            $filename_slider = $foto->slider_file;
        }

        // UPLOAD SLIDER FOTO
        if( $request->has('slider_foto') ) {
            $slider_foto_array = [];
            foreach( $request->file('slider_foto') as $slider_foto ) {
                $tujuan_upload_file_slider_foto = 'assets/foto/slider_foto';
                $filename_slider_foto = uniqid() . '.' . $slider_foto->getClientOriginalExtension();
                $slider_foto->move($tujuan_upload_file_slider_foto, $filename_slider_foto);
                $slider_foto_array[] = $filename_slider_foto;
                
                foreach( unserialize($foto->slider_foto) as $sf_lama ) {
                    File::delete(storage_path('app/public/assets/foto/slider_foto', $sf_lama));
                }
            }
            $slider_foto_array = serialize($slider_foto_array);
        } else {
            $slider_foto_array = $foto->slider_foto;
        }
        
        $foto->update([
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
            'slider_foto' => $slider_foto_array,
            'caption_slider_foto' => serialize($request->caption_slider_foto),
            'slider_utama' => $request->slider_utama != null ? true : false,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft'
        ]);

        // SYNC REMPAH FOTO
        $foto->rempahs()->sync($request->rempah);

        // SYNC KATEGORI SHOW FOTO
        $foto->kategori_show()->sync($request->kategori_show);

        return redirect()->route('admin.photo.index');
    }

    public function delete($photoId)
    {
        $foto = Foto::findOrFail($photoId);

        if( $foto->slider_file != null )
            File::delete(storage_path('app/public/assets/foto/slider', $foto->slider_file));   
        
        foreach( unserialize($foto->slider_foto) as $sf_lama ) {
            File::delete(storage_path('app/public/assets/foto/slider_foto', $sf_lama));
        }
        File::delete(storage_path('app/public/assets/foto/thumbnail', $foto->thumbnail));
        $foto->delete();

        return redirect()->route('admin.photo.index');
    }
}
