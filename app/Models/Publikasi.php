<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Publikasi extends Model implements Viewable
{
    use HasFactory, InteractsWithViews;

    protected $guarded = [];

    public function rempahs()
    {
        return $this->belongsToMany('App\Models\Rempah', 'publikasi_rempah', 'id_publikasi', 'id_rempah');
    }

    public function kategori_show()
    { 
        return $this->belongsToMany('App\Models\KategoriShow', 'publikasi_kategori_show', 'id_publikasi', 'id_kategori_show');
    }
}
