<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Foto;
use Illuminate\Pagination\Paginator;

use Carbon\Carbon;

class FotoController extends Controller
{
    public function index()
    {
        $foto = Foto::where('status', 'publikasi')->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc');

        if( Session::get('lg') == 'en' ){
            $foto = $foto->where('judul_english', '!=', null)->paginate(9);

            if( Paginator::resolveCurrentPage() != 1 ) {
                $fotos = [];
                $i = 0;
                foreach( $foto as $a ) {
                    $fotos[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                    $fotos[$i]['thumbnail'] = $a->thumbnail;
                    $j = 0;
                    foreach( $a->kategori_show as $ks ) {
                        $fotos[$i]['kategori_show'][$j] = $ks->isi;
                        $j++;
                    }
                    $fotos[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                    $fotos[$i]['slug'] = $a->slug;
                    $fotos[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                    $fotos[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                    $i++;
                }
                return response()->json([
                    'status' => 'success', 
                    'data' => $fotos
                ]);
            } else {
                return view('content_english.photos', compact('foto'));
            }

        }
        $foto = $foto->paginate(9);

        if( Paginator::resolveCurrentPage() != 1 ) {
            $fotos = [];
            $i = 0;
            foreach( $foto as $a ) {
                $fotos[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                $fotos[$i]['thumbnail'] = $a->thumbnail;
                $j = 0;
                foreach( $a->kategori_show as $ks ) {
                    $fotos[$i]['kategori_show'][$j] = $ks->isi;
                    $j++;
                }
                $fotos[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                $fotos[$i]['slug'] = $a->slug;
                $fotos[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                $fotos[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                $i++;
            }
            return response()->json([
                'status' => 'success', 
                'data' => $fotos
            ]);
        } else {
            return view('content.photos', compact('foto'));
        }

    }

    public function show($slug)
    {
        $lg = Session::get('lg');

        $foto = Foto::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if( $foto->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }
        
        if( $lg == 'en' )
            return view('content_english.photo_detail', compact('foto'));

        return view('content.photo_detail', compact('foto'));
    }

}
