<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rempahs()
    {
        return $this->belongsToMany('App\Models\Rempah', 'video_rempah', 'id_video', 'id_rempah');
    }

    public function kategori_show()
    { 
        return $this->belongsToMany('App\Models\KategoriShow', 'video_kategori_show', 'id_video', 'id_kategori_show');
    }
}
