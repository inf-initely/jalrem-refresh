<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Kegiatan extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = [];

    public function kontributor_relasi()
    {
        return $this->belongsTo('App\Models\Kontributor', 'id_kontributor', 'id');
    }

    public function lokasi()
    {
        return $this->belongsTo('App\Models\Lokasi', 'id_lokasi', 'id');
    }

    public function rempahs()
    {
        return $this->belongsToMany('App\Models\Rempah', 'kegiatan_rempah', 'id_kegiatan', 'id_rempah');
    }

    public function kategori_show()
    {
        return $this->belongsToMany('App\Models\KategoriShow', 'kegiatan_kategori_show', 'id_kegiatan', 'id_kategori_show');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul_indo')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function getPageQuery(int $page, string $lang = "id", int $limit = 9): Builder {
        $query = Kegiatan::select(
            "judul_indo as judul_id",
            "judul_english as judul_en",
            "slug as slug_id",
            "slug_english as slug_en",
            "thumbnail",
            "penulis",
            "id_kontributor",
            "id",
            "published_at"
        )
            ->where("status", "publikasi")
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->forPage($page, $limit);

        if ($lang == "en") {
            $query = $query->whereNotNull('judul_english');
        }

        return $query;
    }

    public static function getDetailQuery(string $slug, string $lang = "id"): Builder {
        $query = Kegiatan::select(
            "judul_indo as judul_id",
            "konten_indo as konten_id",
            "meta_indo as meta_id",
            "keywords_indo as keywords_id",

            "judul_english as judul_en",
            "konten_english as konten_en",
            "meta_english as meta_en",
            "keywords_english as keywords_en",

            "slug as slug_id",
            "slug_english as slug_en",

            "penulis",
            "id_kontributor",
            "id",
            "published_at",

            "thumbnail",
            "status"
        );

        if ($lang == "id") {
            $query = $query->where("slug", $slug);
        }

        if ($lang == "en") {
            $query = $query->where("slug_english", $slug);
        }

        return $query;
    }
}

