<?php

namespace App\Http\Controllers;

use App\Models\All;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Rempah;
use Illuminate\Support\Facades\App;

class RempahController extends Controller
{
    public static function normalizeSpice($spice, string $lang = "id") {
        return [
            "name" => $spice->{"name_".$lang},
            "desc" => $spice->{"desc_".$lang}
        ];
    }

    public function show(string $spiceName)
    {
        $lang = App::getLocale();
        $s = Rempah::getDetailQuery($spiceName)->firstOrFail();
        $spice = RempahController::normalizeSpice($s, $lang);

        $spices = Rempah::getAllQuery()->get()
            ->map(function ($spice) use ($lang) {
                return RempahController::normalizeSpice($spice, $lang);
            });
        $articlesQuery = Artikel::getPageQuery($lang);
        $articles = All::whereSpice($articlesQuery, "artikels", $s->id)->forPage(1, 5)->get()
            ->map(function ($article) use ($lang) {
                return ArtikelController::normalizePageItem($article, $lang);
            });

        return view('content.rempah_detail', compact('spice', 'articles', 'spices'));
    }
}
