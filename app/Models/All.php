<?php

namespace App\Models;

use App\Common;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Artikel;
use App\Models\Foto;
use App\Models\Video;
use App\Models\Audio;
use App\Models\Publikasi;
use App\Models\Kegiatan;
use App\Models\Kerjasama;
use Illuminate\Database\Query\Builder;

class All {
    public static function selectCommonFields(string $type, string $table, int $mediaType) {
        $prefix = $table != "" ? "{$table}." : "";
        return [
            $mediaType === Common::MEDIA_TYPE_THUMBNAIL ? "{$prefix}thumbnail" : DB::raw("NULL as thumbnail"),
            $mediaType === Common::MEDIA_TYPE_CLOUD_KEY ? "{$prefix}cloud_key" : DB::raw("NULL as cloud_key"),
            $mediaType === Common::MEDIA_TYPE_YOUTUBE_KEY ? "{$prefix}youtube_key" : DB::raw("NULL as youtube_key"),
            DB::raw("'$type' as content_type"),
            DB::raw("'$table' as table_name"),
            "{$prefix}judul_indo as judul_id",
            "{$prefix}judul_english as judul_en",
            "{$prefix}slug as slug_id",
            "{$prefix}slug_english as slug_en",
            "{$prefix}id",
            "{$prefix}penulis",
            "{$prefix}id_kontributor",
            "{$prefix}published_at",
            "{$prefix}id_lokasi"
        ];
    }

    public static function selectCommonFieldsNameOnly() {
        return [
            "thumbnail", "cloud_key", "youtube_key",
            "content_type", "table_name",
            "judul_id", "judul_en",
            "slug_id", "slug_en",
            "id",
            "penulis",
            "id_kontributor",
            "published_at",
            "id_lokasi"
        ];
    }

    public static function modelizedItem($item) {
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

        return $model;
    }

    public static function normalizeModel($model, string $lang) {
        return [
            "title" => $model->{'judul_' . $lang},
            "thumbnail" => $model->thumbnail,
            "cloud_key" => $model->cloud_key,
            "youtube_key" => $model->youtube_key,
            "slug" => $model->{'slug_' . $lang},
            "author" => $model->penulis != "admin" ? $model->kontributor_relasi->nama : "admin",
            "author_type" => $model->penulis,
            "content_type" => $model->content_type,
            "table_name" => $model->table_name,
            "location" => $model->id_lokasi,
            "published_at" => Carbon::parse($model->published_at)->isoFormat("D MMMM Y")
        ];
    }

    public static function getAllQuery($itemCb, string $lang = "id") {
        $itemQuery = array_map(function ($item) use ($lang, $itemCb) {
            $cls = "App\\Models\\{$item["model"]}";
            return $itemCb(
                $cls::getPageQuery($lang)
                    ->select(All::selectCommonFields($item["content_type"], $item["table_name"], $item["media_type"])),
                $item
            );
        }, Common::Contents);

        return DB::query()
            ->select(All::selectCommonFieldsNameOnly())
            ->from($itemQuery["article"]
                ->union($itemQuery["photo"])
                ->union($itemQuery["audio"])
                ->union($itemQuery["video"])
                ->union($itemQuery["publication"])
                ->union($itemQuery["event"])
                ->union($itemQuery["partnership"])
            , "subquery_table")
            ->orderByDesc("published_at");
    }

    public static function whereCategory($builder, string $pluralTable, int $categoryId) {
        $table = rtrim($pluralTable, "s");
        $categoryTable = "{$table}_kategori_show";
        return $builder->whereExists(function ($query) use ($categoryTable, $table, $pluralTable, $categoryId) {
            return $query->from($categoryTable)
                ->select(DB::raw(1))
                ->whereColumn("{$categoryTable}.id_{$table}", "{$pluralTable}.id")
                ->where("{$categoryTable}.id_kategori_show", $categoryId);
        });
    }
}
