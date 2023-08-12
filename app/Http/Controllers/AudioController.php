<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

use App\Models\Audio;

use Carbon\Carbon;

class AudioController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $audios = Audio::getPageQuery($lang)->forPage($isApi ? $page : 1, 9)->get();
        $data = $audios->map(function ($audio) use ($lang) {
            $categories = $audio->kategori_show->map(function ($category) {
                return $category->isi;
            });

            return [
                "title" => $audio->{'judul_'.$lang},
                "cloud_key" => $audio->cloud_key,
                "categories" => $categories,
                "slug" => $audio->{'slug_'.$lang}
            ];
        });

        if(!$isApi) {
            return view('content.audios', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function show($slug)
    {
        $lang = App::getLocale();
        $audio = Audio::getDetailQuery($slug, $lang)->firstOrFail();
        if ($audio->status == "draft") {
            if (!isset(auth()->user()->id)) {
                abort(404);
            }
        }

        $content = [
            "title" => $audio->{"judul_" . $lang},
            "content" => $audio->{'konten_' . $lang},
            "cloud_key" => $audio->cloud_key,
            "slug" => $audio->{'slug_' . $lang},
            "published_at" => Carbon::parse($audio->published_at)->isoFormat("D MMMM Y"),
            "author" => $audio->penulis != 'admin' ? $audio->kontributor_relasi->nama : "admin",
            "author_type" => $audio->penulis,
            "content_type" => "audio"
        ];

        return view('content.audio_detail', compact('content'));
    }
}
