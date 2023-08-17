<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Models\Artikel;
use App\Models\Foto;
use App\Models\Video;
use App\Models\Audio;
use App\Models\Publikasi;
use App\Models\Kegiatan;
use App\Models\Kerjasama;

class SearchController extends Controller
{
    public static $THUMBNAIL = 0;
    public static $CLOUD_KEY = 1;
    public static $YOUTUBE_KEY = 2;

    public static function contentFields(string $type, string $table, int $nonNullField) {
        $prefix = $table != "" ? "{$table}." : "";
        return [
            $nonNullField === SearchController::$THUMBNAIL ? "{$prefix}thumbnail" : DB::raw("NULL as thumbnail"),
            $nonNullField === SearchController::$CLOUD_KEY ? "{$prefix}cloud_key" : DB::raw("NULL as cloud_key"),
            $nonNullField === SearchController::$YOUTUBE_KEY ? "{$prefix}youtube_key" : DB::raw("NULL as youtube_key"),
            DB::raw("'$type' as content_type"),
            DB::raw("'$table' as table_name"),
            "{$prefix}judul_indo as judul_id",
            "{$prefix}judul_english as judul_en",
            "{$prefix}slug as slug_id",
            "{$prefix}slug_english as slug_en",
            ...SearchController::commonFields($table)
        ];
    }

    public static function finalFields() {
        return [
            "thumbnail", "cloud_key", "youtube_key",
            "content_type", "table_name",
            "judul_id", "judul_en",
            "slug_id", "slug_en",
            ...SearchController::commonFields()
        ];
    }

    public static function commonFields($table = "") {
        $prefix = $table != "" ? "{$table}." : "";
        return [
            "{$prefix}id",
            "{$prefix}penulis",
            "{$prefix}id_kontributor",
            "{$prefix}published_at",
            "{$prefix}id_lokasi"
        ];
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
            "location" => $model->id_lokasi,
            "published_at" => Carbon::parse($model->published_at)->isoFormat("D MMMM Y")
        ];
    }

    public function search(Request $request)
    {
        $lang = App::getLocale();
        $fieldwhere = $lang == "en" ? "judul_english" : "judul_indo";

        $page = (int)$request->query("page");
        if ($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }
        $query = (string)$request->query("query");

        if ($page == 0) {
            $page = 1;
        }
        $perPage = 9;

        $subquery = DB::query()
            ->select(SearchController::finalFields())
            ->from(
                Artikel::getPageQuery($lang)
                    ->select(SearchController::contentFields("article", "artikels", SearchController::$THUMBNAIL))
                    ->whereRaw("artikels.".$fieldwhere." LIKE ?", ['%'.$query.'%'])
                    ->union(Foto::getPageQuery($lang)
                        ->select(SearchController::contentFields("photo", "fotos", SearchController::$THUMBNAIL))
                        ->whereRaw("fotos.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
                    ->union(Audio::getPageQuery($lang)
                        ->select(SearchController::contentFields("audio", "audio", SearchController::$CLOUD_KEY))
                        ->whereRaw("audio.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
                    ->union(Video::getPageQuery($lang)
                        ->select(SearchController::contentFields("video", "videos", SearchController::$YOUTUBE_KEY))
                        ->whereRaw("videos.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
                    ->union(Publikasi::getPageQuery($lang)
                        ->select(SearchController::contentFields("publication", "publikasis", SearchController::$THUMBNAIL))
                        ->whereRaw("publikasis.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
                    ->union(Kegiatan::getPageQuery($lang)
                        ->select(SearchController::contentFields("event", "kegiatans", SearchController::$THUMBNAIL))
                        ->whereRaw("kegiatans.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
                    ->union(Kerjasama::getPageQuery($lang)
                        ->select(SearchController::contentFields("partnership", "kerjasamas", SearchController::$THUMBNAIL))
                        ->whereRaw("kerjasamas.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
            , "subquery_table")
            ->orderByDesc("published_at");

        $results = DB::table("cte")
            ->select(DB::raw("*"), DB::raw("(SELECT COUNT(*) FROM cte) as count"))
            ->withExpression("cte", $subquery)
            ->limit($perPage)->offset(($page - 1) * $perPage)
            ->get();

        $mapped = $results->map(function ($item) use ($lang) {
            return SearchController::normalizePageItem($item, $lang);
        });

        $total = 0;
        if(count($mapped) > 0) {
            $total = $results[0]->count;
        }

        $contents = new LengthAwarePaginator(
            $mapped,
            $total,
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('content.search_content', compact('contents'));
    }
}
