<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use App\Models\KategoriShow;

class MasaDepanController extends Controller
{
    public function index()
    {
        $kategori = KategoriShow::where('isi', 'masa depan')->first();
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
                return $item->judul_english != null;
            });
        }
        
        $artikel = ( $kategori != null )
           ? $this->paginate($artikel, 9)
           : [];
        
        $artikel->setPath('/tentang-masa-depan');

        if( Session::get('lg') == 'en' ) {
            if( Paginator::resolveCurrentPage() != 1 ) {
                $artikels = [];
                $i = 0;
                foreach( $artikel as $a ) {
                    $artikels[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                    
                    if( $a->getTable() == 'videos' ) {
                        $artikels[$i]['youtubekey'] = $a->youtube_key;
                    } else if( $a->getTable() == 'audio' ) {
                        $artikels[$i]['cloudkey'] = $a->cloud_key;
                    } else {
                        $artikels[$i]['thumbnail'] = $a->thumbnail;
                    }
    
                    $j = 0;
                    foreach( $a->kategori_show as $ks ) {
                        $artikels[$i]['kategori_show'][$j] = $ks->isi;
                        $j++;
                    }
                    $artikels[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                    $artikels[$i]['slug'] = $a->slug;
                    $artikels[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                    $artikels[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                    $artikels[$i]['table'] = $a->getTable();
                    $artikels[$i]['nama_lokasi'] = $a->lokasi->nama_lokasi ?? '';
                    $artikels[$i]['rempahs'] = $a->rempahs;
                    $i++;
                }
                return response()->json([
                    'status' => 'success', 
                    'data' => $artikels
                ]);
            } else {
                return view('content_english.tentang_masadepan', compact('artikel'));
            }
        }

        
        if( Paginator::resolveCurrentPage() != 1 ) {
            $artikels = [];
            $i = 0;
            foreach( $artikel as $a ) {
                $artikels[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                
                if( $a->getTable() == 'videos' ) {
                    $artikels[$i]['youtubekey'] = $a->youtube_key;
                } else if( $a->getTable() == 'audio' ) {
                    $artikels[$i]['cloudkey'] = $a->cloud_key;
                } else {
                    $artikels[$i]['thumbnail'] = $a->thumbnail;
                }

                $j = 0;
                foreach( $a->kategori_show as $ks ) {
                    $artikels[$i]['kategori_show'][$j] = $ks->isi;
                    $j++;
                }
                $artikels[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                $artikels[$i]['slug'] = $a->slug;
                $artikels[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                $artikels[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                $artikels[$i]['table'] = $a->getTable();
                $artikels[$i]['nama_lokasi'] = $a->lokasi->nama_lokasi ?? '';
                $artikels[$i]['rempahs'] = $a->rempahs;
                $i++;
            }
            return response()->json([
                'status' => 'success', 
                'data' => $artikels
            ]);
        } else {
            return view('content.tentang_masadepan', compact('artikel'));
        }
    
    }

    private function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
