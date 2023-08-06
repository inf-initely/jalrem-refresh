<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

use App\Models\Video;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if ($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $videos = Video::getPage($isApi ? $page : 1, $lang);
        $data = $videos->map(function ($video) use ($lang) {
            $categories = $video->kategori_show->map(function ($video) {
                return $video->isi;
            });

            return [
                "title" => $video->{'judul_' . $lang},
                "youtube_key" => $video->youtube_key,
                "categories" => $categories,
                "slug" => $video->{'slug_' . $lang}
            ];
        });

        if (!$isApi) {
            return view('content.videos', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function show($slug)
    {
        $lang = App::getLocale();
        $video = Video::getDetailQuery($slug, $lang)->firstOrFail();
        if ($video->status == "draft") {
            if (!isset(auth()->user()->id)) {
                abort(404);
            }
        }

        $content = [
            "title" => $video->{"judul_" . $lang},
            "content" => $video->{'konten_' . $lang},
            "youtube_key" => $video->youtube_key,
            "slug" => $video->{'slug_' . $lang},
            "published_at" => Carbon::parse($video->published_at)->isoFormat("D MMMM Y"),
            "author" => $video->penulis != 'admin' ? $video->kontributor_relasi->nama : "admin",
            "author_type" => $video->penulis,
            "content_type" => "video"
        ];

        return view('content.video_detail', compact('content'));
    }
}
