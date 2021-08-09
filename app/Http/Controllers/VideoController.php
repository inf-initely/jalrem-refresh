<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::where('status', 'publikasi')->get();

        return view('content.videos', compact('video'));
    }
}
