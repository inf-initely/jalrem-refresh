<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

use App\Models\Kegiatan;
use App\Models\Kerjasama;

class InformasiController extends Controller
{
    public function index()
    {
        $lang = App::getLocale();
        $partnerships = Kerjasama::getPageQuery(1, $lang, 6)->get()->map(function ($partnership) use ($lang) {
            return Kerjasama::normalizePageItem($partnership, $lang);
        });
        $ongoing_events = Kegiatan::getPageQuery(1, $lang, 6)->where("end_date", ">", now())
            ->get()->map(function ($event) use ($lang) {
                return Kegiatan::normalizePageItem($event, $lang);
            });
        $past_events = Kegiatan::getPageQuery(1, $lang, 6)->where("end_date", "<=", now())
            ->get()->map(function ($event) use ($lang) {
                return Kegiatan::normalizePageItem($event, $lang);
            });

        return view('content.informasi', compact('partnerships', 'ongoing_events', 'past_events'));
    }
}
