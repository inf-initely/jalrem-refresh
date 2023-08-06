<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

use App\Models\Artikel;
use Illuminate\Pagination\Paginator;

use Auth;

use Carbon\Carbon;

class ArtikelController extends Controller
{

    public static function normalizePageItem(Artikel $article, string $lang) {
        $categories = $article->kategori_show->map(function ($category) {
            return $category->isi;
        });

        return [
            "title" => $article->{'judul_'.$lang},
            "thumbnail" => $article->thumbnail,
            "categories" => $categories,
            "slug" => $article->{'slug_'.$lang},
            "author" => $article->penulis != 'admin' ? $article->kontributor_relasi->nama : "admin",
            "published_at" => Carbon::parse($article->published_at)->isoFormat("D MMMM Y")
        ];
    }

    public function index(Request $request){
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $articles = Artikel::getPageQuery($isApi ? $page : 1, $lang)->get();
        $data = $articles->map(function ($article) use ($lang) {
            return ArtikelController::normalizePageItem($article, $lang);
        });

        if(!$isApi) {
            return view('content.articles', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function show(Request $request, string $slug)
    {
        $lang = App::getLocale();

        $article = Artikel::getDetailQuery($slug, $lang)->firstOrFail();
        if ($article->status == "draft") {
            if (!isset(auth()->user()->id)) {
                abort(404);
            }
        }

        $latest = Artikel::getPageQuery(1, $lang, 3)
            ->whereKeyNot($article->id)
            ->get()
            ->map(function ($item) use ($lang) {
                return ArtikelController::normalizePageItem($item, $lang);
            });
        $random = Artikel::getRandom(7, $lang)
            ->get()
            ->map(function ($item) use ($lang) {
                return ArtikelController::normalizePageItem($item, $lang);
            });
        $alsoread = $random[0];
        // TODO: add logic to get true popular and related articles
        $popular = $random->slice(1, 3);
        $related = $random->slice(3, 3);

        $categories = $article->kategori_show->map(function ($category) {
            return $category->isi;
        });
        $content = [
            "title" => $article->{'judul_'.$lang},
            "thumbnail" => $article->thumbnail,
            "categories" => $categories,
            "slug" => $article->{'slug_'.$lang},
            "author" => $article->penulis != 'admin' ? $article->kontributor_relasi->nama : "admin",
            "published_at" => Carbon::parse($article->published_at)->isoFormat("D MMMM Y"),
            "content" => $article->{'konten_'.$lang},
            "author_type" => $article->penulis,
            "content_type" => "article",
        ];

        return view('content.article_detail', compact('content', 'latest', 'random', 'popular', 'related', 'alsoread'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        if(Session::get('lg') == 'en' ) {

            $artikel = Artikel::when($search != null, function($query) use ($search) {
                $query->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_english', 'LIKE', '%'.$search . '%')->where('published_at', '<=', Carbon::now());
            })->where('judul_english', '!=', null)->paginate(9);

            return view('content_english.articles', compact('artikel'));
        }

        $artikel = Artikel::when($search != null, function($query) use ($search) {
            $query->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_english', 'LIKE', '%'.$search . '%')->where('published_at', '<=', Carbon::now());
        })->paginate(9);

        return view('content.articles', compact('artikel'));
    }
}
