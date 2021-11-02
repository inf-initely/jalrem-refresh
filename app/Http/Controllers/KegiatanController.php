<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::where('status', 'publikasi')->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc');

        if( Session::get('lg') == 'en' ) {
            $kegiatan = $kegiatan->where('judul_english', '!=', null)->paginate(9);

            if( Paginator::resolveCurrentPage() != 1 ) {
                $events = [];
                $i = 0;
                foreach( $kegiatan as $a ) {
                    $events[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                    $events[$i]['thumbnail'] = $a->thumbnail;
                    $j = 0;
                    foreach( $a->kategori_show as $ks ) {
                        $events[$i]['kategori_show'][$j] = $ks->isi;
                        $j++;
                    }
                    $events[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                    $events[$i]['slug'] = $a->slug;
                    $events[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                    $events[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                    $i++;
                }
                return response()->json([
                    'status' => 'success', 
                    'data' => $events
                ]);
            } else {
                return view('content_english.kegiatan', compact('kegiatan'));
            }
        }
        $kegiatan = $kegiatan->paginate(9);

        if( Paginator::resolveCurrentPage() != 1 ) {
            $events = [];
            $i = 0;
            foreach( $kegiatan as $a ) {
                $events[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                $events[$i]['thumbnail'] = $a->thumbnail;
                $j = 0;
                foreach( $a->kategori_show as $ks ) {
                    $events[$i]['kategori_show'][$j] = $ks->isi;
                    $j++;
                }
                $events[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                $events[$i]['slug'] = $a->slug;
                $events[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                $events[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                $i++;
            }
            return response()->json([
                'status' => 'success', 
                'data' => $events
            ]);
        } else {
            return view('content.kegiatan', compact('kegiatan'));
        }

    }

    public function show($slug)
    {
        $lg = Session::get('lg');

        $kegiatan = Kegiatan::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();
        
        // check draft
        if( $kegiatan->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }
        
        $kegiatanSaatIni = Kegiatan::where('status', 'publikasi')->take(3)->get();

        if( $lg == 'en' )
            return view('content_english.kegiatan_detail', compact('kegiatan', 'kegiatanSaatIni'));

        return view('content.kegiatan_detail', compact('kegiatan', 'kegiatanSaatIni'));
    }
}
