<?php

namespace App\Http\Controllers;

use App\Common;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

use App\Models\Foto;
use Illuminate\Pagination\Paginator;

use Carbon\Carbon;

class FotoController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if ($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $photos = Foto::getPageQuery($lang)->forPage($isApi ? $page : 1, 9)->get();
        $data = $photos->map(function ($photo) use ($lang) {
            $categories = $photo->kategori_show->map(function ($photo) {
                return $photo->isi;
            });

            return [
                "title" => $photo->{'judul_' . $lang},
                "thumbnail" => $photo->thumbnail,
                "categories" => $categories,
                "slug" => $photo->{'slug_' . $lang},
                "author" => $photo->penulis != 'admin' ? $photo->kontributor_relasi->nama : "admin",
                "published_at" => Carbon::parse($photo->published_at)->isoFormat("D MMMM Y")
            ];
        });

        if (!$isApi) {
            return view('content.photos', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function show(Request $request, string $slug)
    {
        $lang = App::getLocale();
        $thephoto = Foto::getDetailQuery($slug, $lang)->firstOrFail();
        if ($thephoto->status == "draft") {
            if (!isset(auth()->user()->id)) {
                abort(404);
            }
        }

        Common::handleSlugRedirection($lang, $slug, $thephoto);

        $urls = unserialize($thephoto->slider_foto);
        // wtf why does this need to be decoded first!!!
        $captions = unserialize(json_decode($thephoto->{'caption_slider_foto_' . $lang}));

        $content = [
            "title" => $thephoto->{'judul_' . $lang},
            "content" => $thephoto->{'konten_' . $lang},
            "photos" => array_map(function (string $url, string $caption) {
                return [
                    "url" => $url,
                    "caption" => $caption
                ];
            }, $urls, $captions),

            "slug" => $thephoto->{'slug_' . $lang},
            "published_at" => Carbon::parse($thephoto->published_at)->isoFormat("D MMMM Y"),
            "author" => $thephoto->penulis != 'admin' ? $thephoto->kontributor_relasi->nama : "admin",
            "author_type" => $thephoto->penulis,
            "content_type" => "photo"
        ];

        $parameters = Common::createSlugParameters($thephoto);

        return view('content.photo_detail', compact('content', 'parameters'));
    }
}
