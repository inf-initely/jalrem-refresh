<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;

use App\Models\Audio;

use Carbon\Carbon;

class AudioController extends Controller
{
    public function index()
    {
        $audio = Audio::where('status', 'publikasi')->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc');

        if( Session::get('lg') == 'en' ) {
            $audio = $audio->where('judul_english', '!=', null)->paginate(1);
            if( Paginator::resolveCurrentPage() != 1 ) {
                $audios = [];
                $i = 0;
                foreach( $audio as $a ) {
                    $audios[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                    $audios[$i]['cloudkey'] = $a->cloud_key;
                    $audios[$i]['slug'] = $a->slug_english ?? $a->slug;
                    $audios[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                    $j = 0;
                    foreach( $a->kategori_show as $ks ) {
                        $audios[$i]['kategori_show'][$j] = $ks->isi;
                        $j++;
                    }
                    $audios[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->diffForHumans();
                    $i++;
                }
                return response()->json([
                    'status' => 'success', 
                    'data' => $audios
                ]);
            } else {
                return view('content_english.audios', compact('audio')); 
            }
        }
        $audio = $audio->paginate(9);
        if( Paginator::resolveCurrentPage() != 1 ) {
            $audios = [];
            $i = 0;
            foreach( $audio as $a ) {
                $audios[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                $audios[$i]['cloudkey'] = $a->cloud_key;
                $j = 0;
                foreach( $a->kategori_show as $ks ) {
                    $audios[$i]['kategori_show'][$j] = $ks->isi;
                    $j++;
                }
                $audios[$i]['konten'] = Session::get('lg') == 'en' ? \Str::limit($a->konten_english, 50, $end='...') : \Str::limit($a->konten_indo, 50, $end='...');
                $audios[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->diffForHumans();
                $i++;
            }
            return response()->json([
                'status' => 'success', 
                'data' => $audios
            ]);
        } else {
            return view('content.audios', compact('audio'));
        }
    }

    public function show($slug)
    {
        $lg = Session::get('lg');
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';

        $audio = Audio::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if( $audio->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        if( $lg == 'en' ) {
            return view('content_english.audio_detail', compact('audio'));   
        }

        return view('content.audio_detail', compact('audio'));
    }
}
