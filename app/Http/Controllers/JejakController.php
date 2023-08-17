<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\Foto;
use App\Models\Video;
use App\Models\Audio;
use App\Models\Publikasi;
use App\Models\Kegiatan;
use App\Models\Kerjasama;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class JejakController extends Controller
{
    public static function getContentsQuery(int $spiceId = -1, int $locationId = -1, string $lang = "id"): Builder {
        $categoryId = 1;
        $items = [
            "article" => ["Artikel", SearchController::$THUMBNAIL],
            "photo" => ["Foto", SearchController::$THUMBNAIL],
            "audio" => ["Audio", SearchController::$CLOUD_KEY],
            "video" => ["Video", SearchController::$YOUTUBE_KEY],
            "publication" => ["Publikasi", SearchController::$THUMBNAIL],
            "event" => ["Kegiatan", SearchController::$THUMBNAIL],
            "partnership" => ["Kerjasama", SearchController::$THUMBNAIL]
        ];

        $queries = array_map(function($item) use ($lang, $spiceId, $locationId, $categoryId) {
            $cls = "App\\Models\\{$item[0]}";
            $media = $item[1];
            $pluralTable = $cls::$tableName;
            $type = $cls::$contentType;
            $table = rtrim($pluralTable, "s");
            $spiceTable = "{$table}_rempah";

            $query = $cls::getPageQuery($lang)
                ->select(SearchController::contentFields($type, $pluralTable, $media))
                ->whereExists(function ($query) use ($categoryId, $pluralTable) {
                    JalurController::whereCategory($query, $pluralTable, $categoryId);
                });

            if($locationId > -1) {
                $query->where("{$pluralTable}.id_lokasi", $locationId);
            }

            if($spiceId > -1) {
                $query
                    ->join($spiceTable, "{$spiceTable}.id_{$table}", "=", "{$pluralTable}.id")
                    ->where("{$spiceTable}.id_rempah", $spiceId);
                    // ->join($spiceTable, function ($join) use ($spiceTable, $table, $pluralTable, $spiceId) {
                    //     $join
                    //         ->on("{$spiceTable}.id_{$table}", "=", "{$pluralTable}.id")
                    //         ->where("{$spiceTable}.id_rempah", $spiceId);
                    // });
            }

            return $query;
        }, $items);

        $subquery = DB::query()
            ->select(SearchController::finalFields())
            ->from(
                $queries["article"]
                    ->union($queries["photo"])
                    ->union($queries["audio"])
                    ->union($queries["video"])
                    ->union($queries["publication"])
                    ->union($queries["event"])
                    ->union($queries["partnership"])
            , "subquery_table");

        return DB::table("cte")
            ->select(DB::raw("*"), DB::raw("(SELECT COUNT(*) FROM cte) as count"))
            ->withExpression("cte", $subquery);
    }

    public static function normalizeSpice($spice, string $lang = "id") {
        return [
            "id" => $spice->id,
            "name" => $spice->{'name_'.$lang}
        ];
    }

    public static function normalizeLocation($location, string $lang = "id") {
        $loc = JejakController::normalizeSpice($location, $lang);
        $loc["latitude"] = $location->latitude;
        $loc["longitude"] = $location->longitude;
        return $loc;
    }

    public function index(Request $request) {
        $page = $request->query("page");
        if($page === null) $page = 0;
        else if(!is_numeric($page))
            return response("query parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        else $page = (int) $page;

        $spiceId = $request->query("spice");
        if($spiceId === null) $spiceId = -1;
        else if(!is_numeric($spiceId))
            return response("query parameter spice should be an unsigned int", Response::HTTP_BAD_REQUEST);
        else $spiceId = (int) $spiceId;

        $locationId = $request->query("area");
        if($locationId === null) $locationId = -1;
        else if(!is_numeric($locationId))
            return response("query parameter area should be an unsigned int", Response::HTTP_BAD_REQUEST);
        else $locationId = (int) $locationId;

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $contents = JejakController::getContentsQuery($spiceId, $locationId, $lang)->forPage($isApi ? $page : 1, 10)->get();
        $data = $contents->map(function ($content) use ($lang) {
            return JalurController::normalizePageItem($content, $lang);
        });

        if(!$isApi) {
            $spices = Rempah::getAllQuery()->get()->map(function ($spice) use ($lang) {
                return JejakController::normalizeSpice($spice, $lang);
            });
            // $locations = Lokasi::getAllQuery()->get()->map(function ($location) use ($lang) {
            //     return JejakController::normalizeLocation($location, $lang);
            // });
            $stats = JejakController::getContentsQuery($spiceId, $locationId, $lang)
                ->select(
                    "cte.id_lokasi as id",
                    DB::raw("(SELECT COUNT(*) FROM cte) as count"),
                    DB::raw("COUNT(cte.id_lokasi) as total")
                )
                ->groupBy("cte.id_lokasi")
                ->get();

            return view('content.tentang_jejak', compact(
                'data',
                'spices',
                // 'locations',
                'stats'
            ));
        }

        return response()->json([
            "data" => $data
        ]);
    }
}
