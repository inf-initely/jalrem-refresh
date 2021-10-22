<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use App\Models\KategoriShow;

class JalurController extends Controller
{
    public function index()
    {
        $kategori = KategoriShow::where('isi', 'jalur')->first();
        $artikel = $kategori->artikel->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        });
        $foto = $kategori->foto->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        });
        $audio = $kategori->audio->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        });
        $video = $kategori->video->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        });
        $publikasi = $kategori->publikasi->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        });
        $kerjasama = $kategori->kerjasama->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        });
        $kegiatan = $kategori->kegiatan->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        });
        $artikel = $artikel->mergeRecursive($foto)->mergeRecursive($audio)->mergeRecursive($video)->mergeRecursive($publikasi)->mergeRecursive($kerjasama)->mergeRecursive($kegiatan);
        
        if( Session::get('lg') == 'en' ) {
            $artikel = $artikel->filter(function($item) {
                return $item->judul_english != null && $item->published_at <= \Carbon\Carbon::now();
            });
        }

        $artikel = ( $kategori != null )
            ? $this->paginate($artikel, 6)
            : [];

        $artikel->setPath('/tentang-jalur');

        if( Session::get('lg') == 'en' )
            return view('content_english.tentang_jalur', compact('artikel'));
        
        // if( Paginator::resolveCurrentPage() != 1 ) {
        //     $artikels = [];
        //     $i = 0;
        //     foreach( $artikels as $a ) {
        //         $artikels[$i]['judul'] = Session::get('lg') == 'en' ? $artikel->judul_english : $artikel->judul_indo;
        //         $artikels[$i]['konten'] = Session::get('lg') ==
        //          'en' ? Str::limit($artikel->konten_english, 50, $end='...') : Str::limit($artikel->konten_indo, 50, $end='...');
        //         $artikels[$i]['published_at'] = $artikel->published_at->diffForHumans();
        //         $i++;
        //     }
        //     return response()->json([
        //         'status' => 'success', 
        //         'data' => $comments_post
        //     ]);
        // } else {
        //     return view('member.post_detail', compact('post', 'comments'));
        // }

        return view('content.tentang_jalur', compact('artikel'));
    }

    private function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    private function filter_publication()
    {
        return $kategori->artikel->filter(function($item) {
            return $item->status == 'publikasi';
        });
    }
}
