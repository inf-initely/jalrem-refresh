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

        $subquery = "SELECT judul_indo as judul_id, judul_english as judul_en, meta_indo as meta_id, meta_english as meta_en,
        keywords_indo as keywords_id, keywords_english as keywords_en, slug as slug_id, slug_english as slug_en,
        thumbnail, cloud_key, youtube_key, content_type, id, penulis, id_kontributor, table_name
        FROM (
            SELECT id, judul_indo, judul_english, meta_indo, meta_english, keywords_indo, keywords_english, slug, slug_english, published_at,
            thumbnail, NULL as cloud_key, NULL as youtube_key, 'article' as content_type, penulis, id_kontributor, 'artikels' as table_name
            FROM artikels
            WHERE status = 'publikasi' AND " . $fieldwhere . " LIKE ?
            UNION
            SELECT id, judul_indo, judul_english, meta_indo, meta_english, keywords_indo, keywords_english, slug, slug_english, published_at,
            thumbnail, NULL as cloud_key, NULL as youtube_key, 'photo' as content_type, penulis, id_kontributor, 'fotos' as table_name
            FROM fotos
            WHERE status = 'publikasi' AND " . $fieldwhere . " LIKE ?
            UNION
            SELECT id, judul_indo, judul_english, meta_indo, meta_english, keywords_indo, keywords_english, slug, slug_english, published_at,
            NULL as thumbnail, cloud_key, NULL as youtube_key, 'audio' as content_type, penulis, id_kontributor, 'audio' as table_name
            FROM audio
            WHERE status = 'publikasi' AND " . $fieldwhere . " LIKE ?
            UNION
            SELECT id, judul_indo, judul_english, meta_indo, meta_english, keywords_indo, keywords_english, slug, slug_english, published_at,
            NULL as thumbnail, NULL as cloud_key, youtube_key, 'video' as content_type, penulis, id_kontributor, 'videos' as table_name
            FROM videos
            WHERE status = 'publikasi' AND " . $fieldwhere . " LIKE ?
            UNION
            SELECT id, judul_indo, judul_english, meta_indo, meta_english, keywords_indo, keywords_english, slug, slug_english, published_at,
            thumbnail, NULL as cloud_key, NULL as youtube_key, 'publication' as content_type, penulis, id_kontributor, 'publikasis' as table_name
            FROM publikasis
            WHERE status = 'publikasi' AND " . $fieldwhere . " LIKE ?
            UNION
            SELECT id, judul_indo, judul_english, meta_indo, meta_english, keywords_indo, keywords_english, slug, slug_english, published_at,
            thumbnail, NULL as cloud_key, NULL as youtube_key, 'event' as content_type, penulis, id_kontributor, 'kegiatans' as table_name
            FROM kegiatans
            WHERE status = 'publikasi' AND " . $fieldwhere . " LIKE ?
            UNION
            SELECT id, judul_indo, judul_english, meta_indo, meta_english, keywords_indo, keywords_english, slug, slug_english, published_at,
            thumbnail, NULL as cloud_key, NULL as youtube_key, 'partnership' as content_type, penulis, id_kontributor, 'kerjasamas' as table_name
            FROM kerjasamas
            WHERE status = 'publikasi' AND " . $fieldwhere . " LIKE ?
        ) as subquery_table
        ORDER BY published_at DESC";

        $results = DB::select("WITH cte1 AS (".$subquery.")
            SELECT *, (select COUNT(*) from cte1) as count FROM cte1
            LIMIT ? OFFSET ?
        ", [
            '%'.$query.'%',
            '%'.$query.'%',
            '%'.$query.'%',
            '%'.$query.'%',
            '%'.$query.'%',
            '%'.$query.'%',
            '%'.$query.'%',
            $perPage,
            ($page - 1) * $perPage,
        ]);

        $mapped = array_map(function ($item) use ($lang) {
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
        }, $results);

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
