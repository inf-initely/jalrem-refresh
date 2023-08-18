<?php

namespace App\Http\Controllers;

use App\Models\All;
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
    public static function normalizePageItem($item, string $lang) {
        $model = All::modelizedItem($item);

        $categories = $model->kategori_show->map(function ($item) {
            return $item->isi;
        });

        $arr = All::normalizeModel($model, $lang);
        $arr["categories"] = $categories;
        return $arr;
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

        $subquery = All::getAllQuery(function($q, $item) use ($fieldwhere, $query) {
            return $q
                ->whereRaw("{$item["table_name"]}.{$fieldwhere} LIKE ?", ["%{$query}%"]);
        });

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
