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
            return $item->status == 'publikasi';
        });
        $foto = $kategori->foto->filter(function($item) {
            return $item->status == 'publikasi';
        });
        $audio = $kategori->audio->filter(function($item) {
            return $item->status == 'publikasi';
        });
        $video = $kategori->video->filter(function($item) {
            return $item->status == 'publikasi';
        });
        $publikasi = $kategori->publikasi->filter(function($item) {
            return $item->status == 'publikasi';
        });
        $kerjasama = $kategori->kerjasama->filter(function($item) {
            return $item->status == 'publikasi';
        });
        $kegiatan = $kategori->kegiatan->filter(function($item) {
            return $item->status == 'publikasi';
        });
        $artikel = $artikel->mergeRecursive($foto)->mergeRecursive($audio)->mergeRecursive($video)->mergeRecursive($publikasi)->mergeRecursive($kerjasama)->mergeRecursive($kegiatan);
        
        if( Session::get('lg') == 'en' ) {
            $artikel = $artikel->filter(function($item) {
                return $item->judul_english != null;
            });
        }

        $artikel = ( $kategori != null )
            ? $this->paginate($artikel, 6)
            : [];

        $artikel->setPath('/tentang-jalur');

        if( Session::get('lg') == 'en' )
            return view('content_english.tentang_jalur', compact('artikel'));

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
