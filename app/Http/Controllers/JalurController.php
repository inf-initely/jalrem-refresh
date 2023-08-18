<?php

namespace App\Http\Controllers;

use App\Models\All;
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
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class JalurController extends Controller
{
    public static function getContentsQuery(string $lang = "id"): Builder {
        $subquery = All::getAllQuery(function ($query, $item) {
            return All::whereCategory($query, $item["table_name"], 2);
        }, $lang);

        return DB::table("cte")
            ->select(DB::raw("*"), DB::raw("(SELECT COUNT(*) FROM cte) as count"))
            ->withExpression("cte", $subquery);
    }

    public static function normalizePageItem($item, string $lang) {
        $model = All::modelizedItem($item);

        $categories = $model->kategori_show->map(function ($item) {
            return $item->isi;
        });

        $spices = $model->rempahs->map(function ($item) use ($lang) {
            return [
                "type" => $lang == "id" ? $item->jenis_rempah : $item->jenis_rempah_english,
                "desc" => $lang == "id" ? $item->keterangan : $item->keterangan_english,
            ];
        });

        $arr = All::normalizeModel($model, $lang);
        $arr["categories"] = $categories;
        $arr["spices"] = $spices;

        return $arr;
    }

    public function index(Request $request) {
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $contents = JalurController::getContentsQuery($lang)->forPage($isApi ? $page : 1, 10)->get();
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
