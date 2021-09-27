<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\Foto;
use App\Models\Audio;
use App\Models\Publikasi;
use App\Models\Video;
use App\Models\Kegiatan;
use App\Models\Kerjasama;

class RedirectController extends Controller
{
    public function index($slug)
    {
        $artikel = Artikel::where('status', 'publikasi')->get();
        $foto = Foto::where('status', 'publikasi')->get();
        $audio = Audio::where('status', 'publikasi')->get();
        $video = Video::where('status', 'publikasi')->get();
        $publikasi = Publikasi::where('status', 'publikasi')->get();
        $kegiatan = Kegiatan::where('status', 'publikasi')->get();
        $kerjasama = Kerjasama::where('status', 'publikasi')->get();

        $konten = $artikel->mergeRecursive($foto)->mergeRecursive($audio)->mergeRecursive($video)->mergeRecursive($kegiatan)->mergeRecursive($kerjasama)->mergeRecursive($publikasi);
        $konten = $konten->filter(function($item) use($slug) {
            return ($item->slug == $slug || $item->slug_english == $slug);
        })->first();
    

        if( $konten ) {
            return redirect()->route(generate_route_content($konten->getTable()) . '_detail', $slug);
        }
        abort(404);

        // if( $slug == 'tentang-jejak' ) {
        //     return redirect()->route('tentangjejak');
        // } else if( $slug == 'tentang-jalur' ) {
        //     return redirect()->route('tentangjalur');
        // } else if( $slug == 'tentang-masa-depan' ) {
        //     return redirect()->route('tentangmasadepan');
        // } else {
        //     $artikel = Artikel::all()
        // }
    }
}
