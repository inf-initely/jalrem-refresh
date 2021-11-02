<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kerjasama;

use Illuminate\Pagination\Paginator;

class KerjasamaController extends Controller
{
    public function index()
    {
        $kerjasama = Kerjasama::where('status', 'publikasi')->where('published_at', '<=', \Carbon\Carbon::now())->orderBy('published_at', 'desc');

        if( Session::get('lg') == 'en' ) {
            $kerjasama = $kerjasama->where('judul_english', '!=', null)->paginate(1);

            if( Paginator::resolveCurrentPage() != 1 ) {
                $partnerships = [];
                $i = 0;
                foreach( $kerjasama as $a ) {
                    $partnerships[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                    $partnerships[$i]['thumbnail'] = $a->thumbnail;
                    $j = 0;
                    foreach( $a->kategori_show as $ks ) {
                        $partnerships[$i]['kategori_show'][$j] = $ks->isi;
                        $j++;
                    }
                    $partnerships[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                    $partnerships[$i]['slug'] = $a->slug;
                    $partnerships[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                    $partnerships[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                    $i++;
                }
                return response()->json([
                    'status' => 'success', 
                    'data' => $partnerships
                ]);
            } else {
                return view('content_english.kerjasama', compact('kerjasama'));
            }

        }
        
        $kerjasama = $kerjasama->paginate(1);

        if( Paginator::resolveCurrentPage() != 1 ) {
            $partnerships = [];
            $i = 0;
            foreach( $kerjasama as $a ) {
                $partnerships[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                $partnerships[$i]['thumbnail'] = $a->thumbnail;
                $j = 0;
                foreach( $a->kategori_show as $ks ) {
                    $partnerships[$i]['kategori_show'][$j] = $ks->isi;
                    $j++;
                }
                $partnerships[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                $partnerships[$i]['slug'] = $a->slug;
                $partnerships[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                $partnerships[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                $i++;
            }
            return response()->json([
                'status' => 'success', 
                'data' => $partnerships
            ]);
        } else {
            return view('content.kerjasama', compact('kerjasama'));
        }

    }
    public function show($slug)
    {
        $lg = Session::get('lg');

        $kerjasama = Kerjasama::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if( $kerjasama->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        if( $lg == 'en' )
            return view('content_english.kerjasama_detail', compact('kerjasama'));
        
        return view('content.kerjasama_detail', compact('kerjasama'));
    }
}
