<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static $content_selector = "*, slug as slug_id, slug_english as slug_en,"
        ."judul_indo as judul_id, judul_english as judul_en,"
        ."meta_indo as meta_id, meta_english as meta_en";
}
