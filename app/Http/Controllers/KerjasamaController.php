<?php

namespace App\Http\Controllers;

use App\Common;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\Kerjasama;

use Illuminate\Pagination\Paginator;

class KerjasamaController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $partnerships = Kerjasama::getPageQuery($lang)->forPage($isApi ? $page : 1, 9)->get();
        $data = $partnerships->map(function ($partnership) use ($lang) {
            return Kerjasama::normalizePageItem($partnership, $lang);
        });

        if(!$isApi) {
            return view('content.kerjasama', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }
    public function show($slug)
    {
        $lang = App::getLocale();

        $partnership = Kerjasama::getDetailQuery($slug, $lang)->firstOrFail();
        if ($partnership->status == "draft") {
            if (!isset(auth()->user()->id)) {
                abort(404);
            }
        }

        Common::handleSlugRedirection($lang, $slug, $partnership);

        $categories = $partnership->kategori_show->map(function ($category) {
            return $category->isi;
        });
        $content = [
            "title" => $partnership->{'judul_'.$lang},
            "thumbnail" => $partnership->thumbnail,
            "categories" => $categories,
            "slug" => $partnership->{'slug_'.$lang},
            "author" => $partnership->penulis != 'admin' ? $partnership->kontributor_relasi->nama : "admin",
            "published_at" => Carbon::parse($partnership->published_at)->isoFormat("D MMMM Y"),
            "content" => $partnership->{'konten_'.$lang},
            "author_type" => $partnership->penulis,
            "content_type" => "event",
        ];

        $parameters = Common::createSlugParameters($partnership);

        return view('content.kerjasama_detail', compact('content', 'parameters'));
    }
}
