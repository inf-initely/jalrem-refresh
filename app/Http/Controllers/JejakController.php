<?php

namespace App\Http\Controllers;

use App\Models\All;
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
        $subquery = All::getAllQuery(function ($query, $item) use ($locationId, $spiceId, $lang) {
            $pluralTable = $item["table_name"];
            $table = rtrim($pluralTable, "s");
            $spiceTable = "{$table}_rempah";

            All::whereCategory($query, $pluralTable, 1);

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
        }, $lang);

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
