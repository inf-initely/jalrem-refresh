<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Artikel extends Model implements Viewable
{
    use HasFactory, InteractsWithViews;
    
    protected $fillable = [
        'judul_indo', 'konten_indo', 'judul_english', 'konten_english', 'thumbnail', 'id_lokasi', 'penulis'
    ];

    public function rempahs()
    {
        return $this->belongsToMany('App\Models\Rempah', 'artikel_rempah', 'id_artikel', 'id_rempah');
    }
}
