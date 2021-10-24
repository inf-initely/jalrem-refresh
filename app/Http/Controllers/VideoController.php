<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Pagination\Paginator;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::where('status', 'publikasi')->where('published_at', '<=', \Carbon\Carbon::now())->orderBy('published_at', 'desc');

        if( Session::get('lg') == 'en' ) {
            $video = $video->where('judul_english', '!=', null)->paginate(9);

            if( Paginator::resolveCurrentPage() != 1 ) {
                $videos = [];
                $i = 0;
                foreach( $video as $a ) {
                    $videos[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                    $videos[$i]['youtubekey'] = $a->youtube_key;
                    $j = 0;
                    foreach( $a->kategori_show as $ks ) {
                        $videos[$i]['kategori_show'][$j] = $ks->isi;
                        $j++;
                    }
                    $videos[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                    $videos[$i]['slug'] = $a->slug;
                    $videos[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                    $videos[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                    $i++;
                }
                return response()->json([
                    'status' => 'success', 
                    'data' => $videos
                ]);
            } else {
                return view('content_english.videos', compact('video'));
            }

        }
        $video = $video->paginate(9);

        if( Paginator::resolveCurrentPage() != 1 ) {
            $videos = [];
            $i = 0;
            foreach( $video as $a ) {
                $videos[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                $videos[$i]['youtubekey'] = $a->youtube_key;
                $j = 0;
                foreach( $a->kategori_show as $ks ) {
                    $videos[$i]['kategori_show'][$j] = $ks->isi;
                    $j++;
                }
                $videos[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                $videos[$i]['slug'] = $a->slug;
                $videos[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                $videos[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                $i++;
            }
            return response()->json([
                'status' => 'success', 
                'data' => $videos
            ]);
        } else {
            return view('content.videos', compact('video'));
        }
    }

    public function show($slug)
    {
        $lg = Session::get('lg');
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';

        $video = Video::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if( $video->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        if( $lg == 'en' ) {
            return view('content_english.video_detail', compact('video'));
        }

        return view('content.video_detail', compact('video'));
    }
}
