<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Models\Foto;
use App\Models\Rempah;
use App\Models\KategoriShow;
use App\Models\Lokasi;
use App\Models\Kontributor;

use Alert;

class FotoController extends Controller
{
    public function index()
    {
        $foto = Foto::orderBy('created_at', 'desc')->get();
        return view('admin.content.photo.index', compact('foto'));
    }

    public function add() 
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
        $kontributor = Kontributor::all();

        return view('admin.content.photo.add', compact('rempahs', 'lokasi', 'kategori_show', 'kontributor'));
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
        $filename_thumbnail = upload_file('app/public/assets/foto/thumbnail', $thumbnail);

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/foto/slider', $slider);
        } else {
            $filename_slider = null;
        }

        // UPLOAD SLIDER FOTO
        foreach( $request->file('slider_foto') as $slider_foto ) {
            $filename_slider_foto = upload_file('app/public/assets/foto/slider_foto', $slider_foto);
            $slider_foto_array[] = $filename_slider_foto;
        }

        $slider_foto_array = serialize($slider_foto_array);
        
        $slug_english = null;
        if( $request->judul_english )
            $slug_english = generate_slug($request->judul_english, '-');

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
            'slug_english' => $slug_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => ($request->contributor != null && $request->id_kontributor != null) ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => ($request->contributor != null && $request->id_kontributor != null) ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'slider_foto' => $slider_foto_array,
            'caption_slider_foto' => serialize($request->caption_slider_foto),
            'caption_slider_foto_english' => serialize($request->caption_slider_foto_english),
            'slider_utama' => $request->slider_utama != null ? 1 : 0,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft',
            'published_at' => $request->publish_date . " " . $request->publish_time
        ]);
        // ATTACH REMPAH FOTO
        $foto->rempahs()->attach($request->rempah);

        // ATTACH KATEGORI SHOW FOTO
        $foto->kategori_show()->attach($request->kategori_show);

        Alert::success('Berhasil', 'Foto berhasil ditambahkan');

        return redirect()->route('admin.photo.index');
    }

    public function edit($photoId)
    {
        $foto = Foto::findOrFail($photoId);
        $lokasi = Lokasi::all();
        $rempahs = Rempah::all();
        $kategori_show = KategoriShow::where('id', '!=', 4)->where('id', '!=', 5)->get();
        $kontributor = Kontributor::all();


        return view('admin.content.photo.edit', compact('foto', 'lokasi', 'kategori_show', 'rempahs', 'kontributor'));
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
            $filename_thumbnail = upload_file('app/public/assets/foto/thumbnail', $thumbnail);

            File::delete(storage_path('app/public/assets/foto/thumbnail', $foto->thumbnail));
        } else {
            $filename_thumbnail = $foto->thumbnail;
        }
    

        // UPLOAD FILE SLIDER UTAMA(NULLABLE)
        if( $request->has('slider') ) {
            $slider = $request->file('slider');
            $filename_slider = upload_file('app/public/assets/foto/slider', $slider);

            File::delete(storage_path('app/public/assets/foto/slider', $foto->slider));            
        } else {
            $filename_slider = $foto->slider_file;
        }

        // UPLOAD SLIDER FOTO
        $slider_foto_array = [];
        // for( $i = 0; $i < count($request->slider_foro); $i++ ) }{


        for( $i = 0; $i < 11; $i++ ) {
            if( isset($request->caption_slider_foto[$i]) && !isset($request->slider_foto[$i]) ) {
                $slider_foto_array[] = unserialize($foto->slider_foto)[$i];
            } else if( isset($request->caption_slider_foto[$i]) && isset($request->slider_foto[$i]) ) {
                $slider_foto = $request->file('slider_foto')[$i];
                $filename_slider_foto = upload_file('app/public/assets/foto/slider_foto', $slider_foto);
                $slider_foto_array[] = $filename_slider_foto;
            } else if( !isset($request->caption_slider_foto[$i]) && !isset($request->slider_foto[$i]) ) {
                unset($slider_foto_array[$i]);
            }
        }
        $slider_foto_array = serialize($slider_foto_array);
        

        $slug_english = null;
        if( !$foto->slug_english ) {
            $slug_english = generate_slug($request->judul_english, '-');
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
            'slug_english' => $slug_english == null ? $foto->slug_english : $slug_english,
            'id_lokasi' => $request->id_lokasi,
            'penulis' => ($request->contributor != null && $request->id_kontributor != null) ? 'kontributor umum/pamong budaya' : 'admin',
            'id_kontributor' => ($request->contributor != null && $request->id_kontributor != null) ? $request->id_kontributor : null,
            'slider_file' => $request->slider_utama != null ? $filename_slider : null,
            'slider_foto' => $slider_foto_array,
            'caption_slider_foto' => serialize($request->caption_slider_foto),
            'caption_slider_foto_english' => serialize($request->caption_slider_foto_english),
            'slider_utama' => $request->slider_utama != null ? true : false,
            'contributor' => $request->contributor_type,
            'status' => $request->publish != null ? 'publikasi' : 'draft',
            'published_at' => $request->publish_date . " " . $request->publish_time
        ]);

        // SYNC REMPAH FOTO
        $foto->rempahs()->sync($request->rempah);

        // SYNC KATEGORI SHOW FOTO
        $foto->kategori_show()->sync($request->kategori_show);

        Alert::success('Berhasil', 'Foto berhasil diedit');

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
