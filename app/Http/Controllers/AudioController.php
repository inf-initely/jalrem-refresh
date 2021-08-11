<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Audio;

class AudioController extends Controller
{
    public function index()
    {
        $audio = Audio::where('status', 'publikasi')->get();

        return view('content.audios', compact('audio'));
    }

    public function show($audioId)
    {
        $audio = Audio::findOrFail($audioId);

        return view('content.audio_detail', compact('audio'));
    }
}
