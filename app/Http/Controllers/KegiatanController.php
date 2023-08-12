<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $events = Kegiatan::getPageQuery($lang)->forPage($isApi ? $page : 1, 9)->get();
        $data = $events->map(function ($event) use ($lang) {
            return Kegiatan::normalizePageItem($event, $lang);
        });

        if(!$isApi) {
            return view('content.events', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function show($slug)
    {
        $lang = App::getLocale();

        $event = Kegiatan::getDetailQuery($slug, $lang)->firstOrFail();
        if ($event->status == "draft") {
            if (!isset(auth()->user()->id)) {
                abort(404);
            }
        }

        $latest = Kegiatan::getPageQuery($lang)->forPage(1, 3)
            ->whereKeyNot($event->id)
            ->get()
            ->map(function ($item) use ($lang) {
                return Kegiatan::normalizePageItem($item, $lang);
            });

        $categories = $event->kategori_show->map(function ($category) {
            return $category->isi;
        });
        $content = [
            "title" => $event->{'judul_'.$lang},
            "thumbnail" => $event->thumbnail,
            "categories" => $categories,
            "slug" => $event->{'slug_'.$lang},
            "author" => $event->penulis != 'admin' ? $event->kontributor_relasi->nama : "admin",
            "published_at" => Carbon::parse($event->published_at)->isoFormat("D MMMM Y"),
            "content" => $event->{'konten_'.$lang},
            "author_type" => $event->penulis,
            "content_type" => "event",
        ];

        return view('content.kegiatan_detail', compact('content', 'latest'));
    }
}
