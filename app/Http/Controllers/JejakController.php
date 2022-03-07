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
            $value_type = Rempah::orderBy(Session::get('lg') == 'en' ? 'jenis_rempah_english' : 'jenis_rempah', 'asc')->get();
            $artikel = collect($artikelRempah);
        } else if( $lokasi ) {
            foreach( $kategori->artikel as $ka ) {
                if( $ka->id_lokasi == $lokasi->id )
                    $artikelWilayah[] = $ka;
            }

            foreach( $kategori->foto as $ka ) {
                if( $ka->id_lokasi == $lokasi->id )
                    $artikelWilayah[] = $ka;
            }

            foreach( $kategori->audio as $ka ) {
                if( $ka->id_lokasi == $lokasi->id )
                    $artikelWilayah[] = $ka;
            }

            foreach( $kategori->video as $ka ) {
                if( $ka->id_lokasi == $lokasi->id )
                    $artikelWilayah[] = $ka;
            }

            foreach( $kategori->publikasi as $ka ) {
                if( $ka->id_lokasi == $lokasi->id )
                    $artikelWilayah[] = $ka;
            }

            foreach( $kategori->kerjasama as $ka ) {
                if( $ka->id_lokasi == $lokasi->id )
                    $artikelWilayah[] = $ka;
            }

            foreach( $kategori->kegiatan as $ka ) {
                if( $ka->id_lokasi == $lokasi->id )
                    $artikelWilayah[] = $ka;
            }

            $value_type = Lokasi::all();
            $artikel = collect($artikelWilayah);
        } else {
            $artikel = $kategori->artikel->mergeRecursive($kategori->foto)->mergeRecursive($kategori->audio)->mergeRecursive($kategori->video)->mergeRecursive($kategori->publikasi)->mergeRecursive($kategori->kerjasama)->mergeRecursive($kategori->kegiatan);
        }

        $artikel = $artikel->filter(function($item) {
            return $item->status == 'publikasi';
        });

        if( Session::get('lg') == 'en' ) {
            $artikel = $artikel->filter(function($item) {
                return $item->judul_english != null;
            });
        }

        // $artikel = array_mergeRecursive($artikel, $artikelRempah, $artikelWilayah);
        
        $artikel = ( $kategori != null )
            ? $this->paginate($artikel,9)
            : [];

        $artikel->setPath('/tentang-jejak?rempah=' . $rempahId . '&wilayah=' . $lokasiId);

        // dd($kategori->artikel);
        
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
                return view('content_english.tentang_jejak', compact('artikel', 'value_type'));
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
            return view('content.tentang_jejak', compact('artikel', 'value_type'));
        }
    }

    private function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    private function loopingArtikel($type, $container, $kategori)
    {
        // foreach( $kategori->artikel->filter(function($item) {
        //     return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        // }) as $ka ) {
        //     foreach( $type->artikel as $ta ) {
        //         if( $ka->id == $ta->id )
        //             $container[] = $ka;
        //     }
        // }

        foreach( $kategori->artikel->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        }) as $ka ) {
            $container[] = $ka;
        }

        foreach( $kategori->foto->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        }) as $ka ) {
            foreach( $type->foto as $ta ) {
                if( $ka->id == $ta->id )
                    $container[] = $ka;
            }
        }

        foreach( $kategori->audio->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        }) as $ka ) {
            foreach( $type->audio as $ta ) {
                if( $ka->id == $ta->id )
                    $container[] = $ka;
            }
        }

        foreach( $kategori->video->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        }) as $ka ) {
            foreach( $type->video as $ta ) {
                if( $ka->id == $ta->id )
                    $container[] = $ka;
            }
        }

        foreach( $kategori->publikasi->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        }) as $ka ) {
            foreach( $type->publikasi as $ta ) {
                if( $ka->id == $ta->id )
                    $container[] = $ka;
            }
        }

        foreach( $kategori->kerjasama->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        }) as $ka ) {
            foreach( $type->kerjasama as $ta ) {
                if( $ka->id == $ta->id )
                    $container[] = $ka;
            }
        }

        foreach( $kategori->kegiatan->filter(function($item) {
            return $item->status == 'publikasi' && $item->published_at <= \Carbon\Carbon::now();
        }) as $ka ) {
            foreach( $type->kegiatan as $ta ) {
                if( $ka->id == $ta->id )
                    $container[] = $ka;
            }
        }
        return $container;
    }
}
