<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::where('status', 'publikasi')->orderBy('created_at', 'desc')->paginate(9);

        if( Session::get('lg') == 'en' ) {
            return view('content_english.videos', compact('video'));
        }

        return view('content.videos', compact('video'));
    }

    public function show($slug)
    {
        $lg = Session::get('lg');
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';

        $video = Video::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        if( $lg == 'en' ) {
            return view('content_english.video_detail', compact('video'));
        }

        return view('content.video_detail', compact('video'));
    }
}
