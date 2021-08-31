<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;

class JejakController extends Controller
{
    public function index(Request $request)
    {
        $rempahId = $request->get('rempah');
        $lokasiId = $request->get('wilayah');

        $kategori = KategoriShow::where('isi', 'jejak')->first();

        $rempah = Rempah::find($rempahId);
        $lokasi = Lokasi::find($lokasiId);

        $artikel = [];
        $artikelRempah = [];
        $artikelWilayah = [];

        $value_type = []; // untuk menampikan isi rempah jika sebelumnya memilih rempah dan wilayah jika sebelumnya memilih wilayah
        if( $rempah ) {
            $artikelRempah = $this->loopingArtikel($rempah, $artikelRempah, $kategori);
            $value_type = Rempah::all();
            $artikel = $artikelRempah;
        } else if( $lokasi ) {
            foreach( $kategori->artikel as $ka ) {
                if( $ka->id_lokasi == $lokasi->id )
                    $artikelWilayah[] = $ka;
            }
            $value_type = Lokasi::all();
            $artikel = $artikelWilayah;
        } else {
            $artikel = $kategori->artikel;
        }

        $artikel = $artikel->filter(function($item) {
            return $item->status == 'publikasi';
        });

        // $artikel = array_merge($artikel, $artikelRempah, $artikelWilayah);
        
        $artikel = ( $kategori != null )
            ? $this->paginate($artikel,6)
            : [];

        $artikel->setPath('/tentang-jejak?rempah=' . $rempahId . '&wilayah=' . $lokasiId);

        // dd($kategori->artikel);
        
        if( Session::get('lg') == 'en' )
            return view('content_english.tentang_jejak', compact('artikel', 'value_type'));

        return view('content.tentang_jejak', compact('artikel', 'value_type'));
    }

    private function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    private function loopingArtikel($type, $container, $kategori)
    {
        foreach( $kategori->artikel as $ka ) {
            foreach( $type->artikel as $ta ) {
                if( $ka->id == $ta->id )
                    $container[] = $ka;
            }
        }
        return $container;
    }
}
