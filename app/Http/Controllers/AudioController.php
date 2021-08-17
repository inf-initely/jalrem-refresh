<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Audio;

class AudioController extends Controller
{
    public function index()
    {
        $audio = Audio::where('status', 'publikasi')->orderBy('created_at', 'desc')->paginate(9);

        if( Session::get('lg') == 'en' ) {
            return view('content_english.audios', compact('audio')); 
        }

        return view('content.audios', compact('audio'));
    }

    public function show($slug)
    {
        $audio = Audio::where('slug', $slug)->firstOrFail();

        if( Session::get('lg') == 'en' ) {
            return view('content_english.audio_detail', compact('audio'));   
        }

        return view('content.audio_detail', compact('audio'));
    }
}
