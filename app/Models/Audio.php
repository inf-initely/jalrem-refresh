<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rempahs()
    {
        return $this->belongsToMany('App\Models\Rempah', 'audio_rempah', 'id_audio', 'id_rempah');
    }

    public function kategori_show()
    { 
        return $this->belongsToMany('App\Models\KategoriShow', 'audio_kategori_show', 'id_audio', 'id_kategori_show');
    }
}
