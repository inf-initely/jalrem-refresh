<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::where('status', 'publikasi')->orderBy('created_at', 'desc');

        if( Session::get('lg') == 'en' ) {
            $video = $video->where('judul_english', '!=', null)->paginate(9);
            return view('content_english.videos', compact('video'));
        }
        $video = $video->paginate(9);

        return view('content.videos', compact('video'));
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
