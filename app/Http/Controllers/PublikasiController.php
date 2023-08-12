<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Pagination\Paginator;

use App\Models\Publikasi;

class PublikasiController extends Controller
{
    public static function normalizePageItem(Publikasi $publication, string $lang) {
        $categories = $publication->kategori_show->map(function ($category) {
            return $category->isi;
        });

        return [
            "title" => $publication->{'judul_'.$lang},
            "thumbnail" => $publication->thumbnail,
            "iframe" => $publication->iframe,
            "categories" => $categories,
            "slug" => $publication->{'slug_'.$lang},
            "author" => $publication->penulis != 'admin' ? $publication->kontributor_relasi->nama : "admin",
            "published_at" => Carbon::parse($publication->published_at)->isoFormat("D MMMM Y")
        ];
    }

    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if ($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $publications = Publikasi::getPageQuery($lang)->forPage($isApi ? $page : 1, 9)->get();
        $data = $publications->map(function ($publication) use ($lang) {
            $categories = $publication->kategori_show->map(function ($publication) {
                return $publication->isi;
            });

            return [
                "title" => $publication->{'judul_' . $lang},
                "thumbnail" => $publication->thumbnail,
                "categories" => $categories,
                "slug" => $publication->{'slug_' . $lang},
                "author" => $publication->penulis != 'admin' ? $publication->kontributor_relasi->nama : "admin",
                "published_at" => Carbon::parse($publication->published_at)->isoFormat("D MMMM Y")
            ];
        });

        if (!$isApi) {
            return view('content.publications', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function show($slug)
    {
        $lang = App::getLocale();

        $publication = Publikasi::getDetailQuery($slug, $lang)->firstOrFail();
        if ($publication->status == "draft") {
            if (!isset(auth()->user()->id)) {
                abort(404);
            }
        }

        $latest = Publikasi::getPageQuery($lang)
            ->forPage(1, 3)
            ->whereKeyNot($publication->id)
            ->get()
            ->map(function ($item) use ($lang) {
                return PublikasiController::normalizePageItem($item, $lang);
            });
        $random = Publikasi::getRandomQuery(7, $lang)
            ->get()
            ->map(function ($item) use ($lang) {
                return PublikasiController::normalizePageItem($item, $lang);
            });
        $alsoread = $random[0];
        // TODO: add logic to get true popular and related publications
        $popular = $random->slice(1, 3);
        $related = $random->slice(3, 3);

        $categories = $publication->kategori_show->map(function ($category) {
            return $category->isi;
        });
        $content = [
            "title" => $publication->{'judul_'.$lang},
            "thumbnail" => $publication->thumbnail,
            "iframe" => $publication->iframe,
            "categories" => $categories,
            "slug" => $publication->{'slug_'.$lang},
            "author" => $publication->penulis != 'admin' ? $publication->kontributor_relasi->nama : "admin",
            "published_at" => Carbon::parse($publication->published_at)->isoFormat("D MMMM Y"),
            "content" => $publication->{'konten_'.$lang},
            "author_type" => $publication->penulis,
            "content_type" => "publication",
        ];

        return view('content.publication_detail', compact('content', 'latest', 'random', 'popular', 'related', 'alsoread'));
    }
}
