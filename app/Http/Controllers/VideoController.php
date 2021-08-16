<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::where('status', 'publikasi')->paginate(9);

        if( request()->get('lg') == 'en' ) {
            return view('content_english.videos', compact('video'));
        }

        return view('content.videos', compact('video'));
    }

    public function show($slug)
    {
        $video = Video::findOrFail('slug', $slug)->firstOrFail();

        if( request()->get('lg') == 'en' ) {
            return view('content_english.video_detail', compact('video'));
        }

        return view('content.video_detail', compact('video'));
    }
}
