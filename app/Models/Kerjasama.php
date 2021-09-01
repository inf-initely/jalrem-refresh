<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Kerjasama extends Model
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
        return $this->belongsToMany('App\Models\Rempah', 'kerjasama_rempah', 'id_kerjasama', 'id_rempah');
    }

    public function kategori_show()
    { 
        return $this->belongsToMany('App\Models\KategoriShow', 'kerjasama_kategori_show', 'id_kerjasama', 'id_kategori_show');
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
}
