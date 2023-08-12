<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Foto extends Model
{
    use HasFactory, HasSlug;

    protected $casts = [
        'slider_foto' => 'array',
        'caption_slider_foto' => 'array',
        'caption_slider_foto_english' => 'array',
    ];

    public function kontributor_relasi()
    {
        return $this->belongsTo('App\Models\Kontributor', 'id_kontributor', 'id');
    }

    public function lokasi()
    {
        return $this->belongsTo('App\Models\Lokasi', 'id_lokasi', 'id');
    }

    protected $guarded = [];

    public function rempahs()
    {
        return $this->belongsToMany('App\Models\Rempah', 'foto_rempah', 'id_foto', 'id_rempah');
    }

    public function kategori_show()
    {
        return $this->belongsToMany('App\Models\KategoriShow', 'foto_kategori_show', 'id_foto', 'id_kategori_show');
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

    public static function getPageQuery(string $lang = "id"): Builder {
        $query = Foto::select(
            "judul_indo as judul_id",
            "judul_english as judul_en",
            "slug as slug_id",
            "slug_english as slug_en",
            "thumbnail",
            "penulis",
            "id_kontributor",
            "id",
            "published_at",
        )
            ->where("status", "publikasi")
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');

        if ($lang == "en") {
            $query = $query->whereNotNull('judul_english');
        }

        return $query;
    }

    public static function getDetailQuery(string $slug, string $lang = "id"): Builder {
        $query = Foto::select(
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

            "slider_foto",
            "caption_slider_foto_english as caption_slider_foto_en",
            "caption_slider_foto as caption_slider_foto_id",
            "caption_slider_foto",
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
