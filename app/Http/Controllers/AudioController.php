<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Audio;

class AudioController extends Controller
{
    public function index()
    {
        $audio = Audio::where('status', 'publikasi')->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc');

        if( Session::get('lg') == 'en' ) {
            $audio = $audio->where('judul_english', '!=', null)->paginate(9);
            return view('content_english.audios', compact('audio')); 
        }
        $audio = $audio->paginate(9);
        return view('content.audios', compact('audio'));
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
