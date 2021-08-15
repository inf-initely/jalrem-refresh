<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Audio;

class AudioController extends Controller
{
    public function index()
    {
        $audio = Audio::where('status', 'publikasi')->paginate(9);

        return view('content.audios', compact('audio'));
    }

    public function show($slug)
    {
        $audio = Audio::where('slug', $slug)->firstOrFail();

        return view('content.audio_detail', compact('audio'));
    }
}
