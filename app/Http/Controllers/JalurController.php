<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use App\Models\Foto;
use App\Models\Video;
use App\Models\Audio;
use App\Models\Publikasi;
use App\Models\Kegiatan;
use App\Models\Kerjasama;
use App\Models\KategoriShow;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class JalurController extends Controller
{
    public static function whereCategory(Builder $builder, string $pluralTable, int $categoryId): Builder {
        $table = rtrim($pluralTable, "s");
        $categoryTable = "{$table}_kategori_show";
        return $builder->from($categoryTable)
            ->select(DB::raw($categoryId))
            ->whereColumn("{$categoryTable}.id_{$table}", "{$pluralTable}.id")
            ->where("{$categoryTable}.id_kategori_show", $categoryId);
    }

    public static function getContentsQuery(int $categoryId, string $lang = "id"): Builder {
        $subquery = DB::query()
            ->select(SearchController::finalFields())
            ->from(
                Artikel::getPageQuery($lang)
                    ->select(SearchController::contentFields("article", "artikels", SearchController::$THUMBNAIL))
                    ->whereExists(function ($query) use ($categoryId) {
                        JalurController::whereCategory($query, "artikels", $categoryId);
                    })
                    ->union(Foto::getPageQuery($lang)
                        ->select(SearchController::contentFields("photo", "fotos", SearchController::$THUMBNAIL))
                        ->whereExists(function ($query) use ($categoryId) {
                            JalurController::whereCategory($query, "fotos", $categoryId);
                        }))
                    ->union(Audio::getPageQuery($lang)
                        ->select(SearchController::contentFields("audio", "audio", SearchController::$CLOUD_KEY))
                        ->whereExists(function ($query) use ($categoryId) {
                            JalurController::whereCategory($query, "audio", $categoryId);
                        }))
                    ->union(Video::getPageQuery($lang)
                        ->select(SearchController::contentFields("video", "videos", SearchController::$YOUTUBE_KEY))
                        ->whereExists(function ($query) use ($categoryId) {
                            JalurController::whereCategory($query, "videos", $categoryId);
                        }))
                    ->union(Publikasi::getPageQuery($lang)
                        ->select(SearchController::contentFields("publication", "publikasis", SearchController::$THUMBNAIL))
                        ->whereExists(function ($query) use ($categoryId) {
                            JalurController::whereCategory($query, "publikasis", $categoryId);
                        }))
                    ->union(Kegiatan::getPageQuery($lang)
                        ->select(SearchController::contentFields("event", "kegiatans", SearchController::$THUMBNAIL))
                        ->whereExists(function ($query) use ($categoryId) {
                            JalurController::whereCategory($query, "kegiatans", $categoryId);
                        }))
                    ->union(Kerjasama::getPageQuery($lang)
                        ->select(SearchController::contentFields("partnership", "kerjasamas", SearchController::$THUMBNAIL))
                        ->whereExists(function ($query) use ($categoryId) {
                            JalurController::whereCategory($query, "kerjasamas", $categoryId);
                        }))
            , "subquery_table")
            ->orderByDesc("published_at");

        return DB::table("cte")
            ->select(DB::raw("*"), DB::raw("(SELECT COUNT(*) FROM cte) as count"))
            ->withExpression("cte", $subquery);
    }

    public static function normalizePageItem($item, string $lang) {
        $model = null;
        $content = (array) $item;
        switch($item->content_type) {
            case "article": $model = new Artikel($content); break;
            case "photo": $model = new Foto($content); break;
            case "audio": $model = new Audio($content); break;
            case "video": $model = new Video($content); break;
            case "publication": $model = new Publikasi($content); break;
            case "event": $model = new Kegiatan($content); break;
            case "partnership": $model = new Kerjasama($content); break;
        }

        $categories = $model->kategori_show->map(function ($item) {
            return $item->isi;
        });

        $location = $model->lokasi;
        if($location != null) {
            $location = $model->lokasi->map(function ($item) use ($lang) {
                return $lang == "id" ? $item->nama_lokasi : $item->nama_lokasi_english;
            });
        } else {
            $location = "";
        }

        $spices = $model->rempahs->map(function ($item) use ($lang) {
            return [
                "type" => $lang == "id" ? $item->jenis_rempah : $item->jenis_rempah_english,
                "desc" => $lang == "id" ? $item->keterangan : $item->keterangan_english,
            ];
        });

        return [
            "title" => $model->{'judul_' . $lang},
            "thumbnail" => $model->thumbnail,
            "cloud_key" => $model->cloud_key,
            "youtube_key" => $model->youtube_key,
            "categories" => $categories,
            "slug" => $model->{'slug_' . $lang},
            "author" => $model->penulis != "admin" ? $model->kontributor_relasi->nama : "admin",
            "author_type" => $model->penulis,
            "content_type" => $model->content_type,
            "table_name" => $model->table_name,
            "published_at" => Carbon::parse($model->published_at)->isoFormat("D MMMM Y"),
            "location" => $location,
            "spices" => $spices,
        ];
    }

    public function index(Request $request) {
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $contents = JalurController::getContentsQuery(2, $lang)->forPage($isApi ? $page : 1, 10)->get();
        $data = $contents->map(function ($content) use ($lang) {
            return JalurController::normalizePageItem($content, $lang);
        });

        if(!$isApi) {
            return view('content.tentang_jalur', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }
}
