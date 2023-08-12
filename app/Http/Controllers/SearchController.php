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
    public static function translatedFields() {
        return [
            "judul_indo as judul_id",
            "judul_english as judul_en",
            "slug as slug_id",
            "slug_english as slug_en",
        ];
    }

    public static function commonFields() {
        return [
            "id",
            "penulis",
            "id_kontributor",
            "published_at"
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
            ->select(
                "thumbnail", "cloud_key", "youtube_key",
                "content_type", "table_name",
                "judul_id", "judul_en", "slug_id", "slug_en",
                ...SearchController::commonFields()
            )
            ->from(
                Artikel::getPageQuery($lang)
                    ->select(
                        DB::raw("thumbnail, NULL as cloud_key, NULL as youtube_key"),
                        DB::raw("'article' as content_type, 'artikels' as table_name"),
                        ...SearchController::translatedFields(),
                        ...SearchController::commonFields(),
                    )
                    ->whereRaw("artikels.".$fieldwhere." LIKE ?", ['%'.$query.'%'])
                    ->union(Foto::getPageQuery($lang)
                        ->select(
                            DB::raw("thumbnail, NULL as cloud_key, NULL as youtube_key"),
                            DB::raw("'photo' as content_type, 'fotos' as table_name"),
                            ...SearchController::translatedFields(),
                            ...SearchController::commonFields(),
                        )
                        ->whereRaw("fotos.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
                    ->union(Audio::getPageQuery($lang)
                        ->select(
                            DB::raw("NULL as thumbnail, cloud_key, NULL as youtube_key"),
                            DB::raw("'audio' as content_type, 'audio' as table_name"),
                            ...SearchController::translatedFields(),
                            ...SearchController::commonFields(),
                        )
                        ->whereRaw("audio.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
                    ->union(Video::getPageQuery($lang)
                        ->select(
                            DB::raw("NULL as thumbnail, NULL as cloud_key, youtube_key"),
                            DB::raw("'video' as content_type, 'videos' as table_name"),
                            ...SearchController::translatedFields(),
                            ...SearchController::commonFields(),
                        )
                        ->whereRaw("videos.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
                    ->union(Publikasi::getPageQuery($lang)
                        ->select(
                            DB::raw("thumbnail, NULL as cloud_key, NULL as youtube_key"),
                            DB::raw("'publication' as content_type, 'publikasis' as table_name"),
                            ...SearchController::translatedFields(),
                            ...SearchController::commonFields(),
                        )
                        ->whereRaw("publikasis.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
                    ->union(Kegiatan::getPageQuery($lang)
                        ->select(
                            DB::raw("thumbnail, NULL as cloud_key, NULL as youtube_key"),
                            DB::raw("'event' as content_type, 'kegiatans' as table_name"),
                            ...SearchController::translatedFields(),
                            ...SearchController::commonFields(),
                        )
                        ->whereRaw("kegiatans.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
                    ->union(Kerjasama::getPageQuery($lang)
                        ->select(
                            DB::raw("thumbnail, NULL as cloud_key, NULL as youtube_key"),
                            DB::raw("'partnership' as content_type, 'kerjasamas' as table_name"),
                            ...SearchController::translatedFields(),
                            ...SearchController::commonFields(),
                        )
                        ->whereRaw("kerjasamas.".$fieldwhere." LIKE ?", ['%'.$query.'%']))
            , "subquery_table")
            ->orderByDesc("published_at");

        $results = DB::table("cte")
            ->select(DB::raw("*"), DB::raw("(SELECT COUNT(*) FROM cte) as count"))
            ->withExpression("cte", $subquery)
            ->limit($perPage)->offset(($page - 1) * $perPage)
            ->get();

        $mapped = $results->map(function ($item) use ($lang) {
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
                "published_at" => Carbon::parse($model->published_at)->isoFormat("D MMMM Y")
            ];
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
