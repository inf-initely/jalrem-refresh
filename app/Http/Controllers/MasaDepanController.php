<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use App\Models\KategoriShow;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class MasaDepanController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $contents = JalurController::getContentsQuery(3, $lang)->forPage($isApi ? $page : 1, 10)->get();
        $data = $contents->map(function ($content) use ($lang) {
            return JalurController::normalizePageItem($content, $lang);
        });

        if(!$isApi) {
            return view('content.tentang_masadepan', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }
}
