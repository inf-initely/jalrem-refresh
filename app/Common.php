<?php

namespace App;

use Illuminate\Support\Facades\Route;

class Common
{
    const MEDIA_TYPE_THUMBNAIL = 0;
    const MEDIA_TYPE_CLOUD_KEY = 1;
    const MEDIA_TYPE_YOUTUBE_KEY = 2;

    const Contents = [
        "article" => [
            "model" => "Artikel",
            "media_type" => Common::MEDIA_TYPE_THUMBNAIL,
            "table_name" => "artikels",
            "content_type" => "article"
        ],
        "photo" => [
            "model" => "Foto",
            "media_type" => Common::MEDIA_TYPE_THUMBNAIL,
            "table_name" => "fotos",
            "content_type" => "photo"
        ],
        "audio" => [
            "model" => "Audio",
            "media_type" => Common::MEDIA_TYPE_CLOUD_KEY,
            "table_name" => "audio",
            "content_type" => "audio"
        ],
        "video" => [
            "model" => "Video",
            "media_type" => Common::MEDIA_TYPE_YOUTUBE_KEY,
            "table_name" => "videos",
            "content_type" => "video"
        ],
        "publication" => [
            "model" => "Publikasi",
            "media_type" => Common::MEDIA_TYPE_THUMBNAIL,
            "table_name" => "publikasis",
            "content_type" => "publication"
        ],
        "event" => [
            "model" => "Kegiatan",
            "media_type" => Common::MEDIA_TYPE_THUMBNAIL,
            "table_name" => "kegiatans",
            "content_type" => "event"
        ],
        "partnership" => [
            "model" => "Kerjasama",
            "media_type" => Common::MEDIA_TYPE_THUMBNAIL,
            "table_name" => "kerjasamas",
            "content_type" => "partnership"
        ]
    ];

    const Locations = [
        1 => [
            'id' => 1,
            'name' => 'Aceh',
            'latitude' => '4.36855000',
            'longitude' => '97.02530000',
        ],
        2 => [
            'id' => 2,
            'name' => 'Bali',
            'latitude' => '-8.23566000',
            'longitude' => '115.12239000',
        ],
        3 => [
            'id' => 3,
            'name' => 'Banten',
            'latitude' => '-6.44538000',
            'longitude' => '106.13756000',
        ],
        4 => [
            'id' => 4,
            'name' => 'Bengkulu',
            'latitude' => '-3.51868000',
            'longitude' => '102.53598000',
        ],
        5 => [
            'id' => 5,
            'name' => 'DI Yogyakarta',
            'latitude' => '-7.79560000',
            'longitude' => '110.36950000',
        ],
        6 => [
            'id' => 6,
            'name' => 'DKI Jakarta',
            'latitude' => '-6.17450000',
            'longitude' => '106.82270000',
        ],
        7 => [
            'id' => 7,
            'name' => 'Gorontalo',
            'latitude' => '0.71862000',
            'longitude' => '122.45559000',
        ],
        8 => [
            'id' => 8,
            'name' => 'Jambi',
            'latitude' => '-1.61157000',
            'longitude' => '102.77970000',
        ],
        9 => [
            'id' => 9,
            'name' => 'Jawa Barat',
            'latitude' => '-6.88917000',
            'longitude' => '107.64047000',
        ],
        10 => [
            'id' => 10,
            'name' => 'Jawa Tengah',
            'latitude' => '-7.30324000',
            'longitude' => '110.00441000',
        ],
        11 => [
            'id' => 11,
            'name' => 'Jawa Timur',
            'latitude' => '-7.27597300',
            'longitude' => '112.80830400',
        ],
        12 => [
            'id' => 12,
            'name' => 'Kalimantan Barat',
            'latitude' => '-0.13224000',
            'longitude' => '111.09689000',
        ],
        13 => [
            'id' => 13,
            'name' => 'Kalimantan Selatan',
            'latitude' => '-2.94348000',
            'longitude' => '115.37565000',
        ],
        14 => [
            'id' => 14,
            'name' => 'Kalimantan Tengah',
            'latitude' => '-1.49958000',
            'longitude' => '113.29033000',
        ],
        15 => [
            'id' => 15,
            'name' => 'Kalimantan Timur',
            'latitude' => '0.78844000',
            'longitude' => '116.24200000',
        ],
        16 => [
            'id' => 16,
            'name' => 'Kalimantan Utara',
            'latitude' => '2.72594000',
            'longitude' => '116.91100000',
        ],
        17 => [
            'id' => 17,
            'name' => 'Kepulauan Bangka Belitung',
            'latitude' => '-2.75775000',
            'longitude' => '107.58394000',
        ],
        18 => [
            'id' => 18,
            'name' => 'Kepulauan Riau',
            'latitude' => '-0.15478000',
            'longitude' => '104.58037000',
        ],
        19 => [
            'id' => 19,
            'name' => 'Lampung',
            'latitude' => '-4.85550000',
            'longitude' => '105.02730000',
        ],
        20 => [
            'id' => 20,
            'name' => 'Maluku',
            'latitude' => '-3.11884000',
            'longitude' => '129.42078000',
        ],
        21 => [
            'id' => 21,
            'name' => 'Maluku Utara',
            'latitude' => '0.63012000',
            'longitude' => '127.97202000',
        ],
        22 => [
            'id' => 22,
            'name' => 'Nusa Tenggara Barat',
            'latitude' => '-8.12179000',
            'longitude' => '117.63696000',
        ],
        23 => [
            'id' => 23,
            'name' => 'Papua',
            'latitude' => '-3.98857000',
            'longitude' => '138.34853000',
        ],
        24 => [
            'id' => 24,
            'name' => 'Papua Barat',
            'latitude' => '-1.38424000',
            'longitude' => '132.90253000',
        ],
        25 => [
            'id' => 25,
            'name' => 'Riau',
            'latitude' => '0.50041000',
            'longitude' => '101.54758000',
        ],
        26 => [
            'id' => 26,
            'name' => 'Sulawesi Barat',
            'latitude' => '-2.49745000',
            'longitude' => '119.39190000',
        ],
        27 => [
            'id' => 27,
            'name' => 'Sulawesi Selatan',
            'latitude' => '-3.64467000',
            'longitude' => '119.94719000',
        ],
        28 => [
            'id' => 28,
            'name' => 'Sulawesi Tengah',
            'latitude' => '-1.69378000',
            'longitude' => '120.80886000',
        ],
        29 => [
            'id' => 29,
            'name' => 'Sulawesi Tenggara',
            'latitude' => '-3.54912000',
            'longitude' => '121.72796000',
        ],
        30 => [
            'id' => 30,
            'name' => 'Sulawesi Utara',
            'latitude' => '0.65557000',
            'longitude' => '124.09015000',
        ],
        31 => [
            'id' => 31,
            'name' => 'Sumatera Barat',
            'latitude' => '-1.14225000',
            'longitude' => '100.57610000',
        ],
        32 => [
            'id' => 32,
            'name' => 'Sumatera Selatan',
            'latitude' => '-3.12668000',
            'longitude' => '104.09306000',
        ],
        33 => [
            'id' => 33,
            'name' => 'Sumatera Utara',
            'latitude' => '2.19235000',
            'longitude' => '99.38122000',
        ],
        34 => [
            'id' => 34,
            'name' => 'Nusa Tenggara Timur',
            'latitude' => '-8.56568000',
            'longitude' => '120.69786000',
        ],
    ];

    public static function isSlugNotFound($slug) {
        return $slug == "n-a" || $slug == "" || $slug == null;
    }

    public static function handleSlugRedirection($lang, $slug, $item) {
        if(Common::isSlugNotFound($slug)) {
            abort(404);
        }
        $trueSlug = $item->{"slug_".$lang};
        if($slug == $trueSlug) return;

        if(Common::isSlugNotFound($trueSlug)) {
            abort(404);
        }

        abort(301, "", [
            "Location" => route(Route::currentRouteName(), ["slug" => $trueSlug])
        ]);
    }

    public static function createSlugParameters($item) {

        $parameters = [
            "id" => ["slug" => $item->slug_id],
            "en" => ["slug" => $item->slug_en]
        ];

        if(Common::isSlugNotFound($item->slug_id)) {
            $parameters["stub"] = ["id" => true];
        }

        if(Common::isSlugNotFound($item->slug_en)) {
            $parameters["stub"] = ["en" => true];
        }

        return $parameters;
    }
}
