<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $casts = [
        'slider_foto' => 'array'
    ];

    protected $guarded = [];

    public function rempahs()
    {
        return $this->belongsToMany('App\Models\Rempah', 'foto_rempah', 'id_foto', 'id_rempah');
    }

    public function kategori_show()
    { 
        return $this->belongsToMany('App\Models\KategoriShow', 'foto_kategori_show', 'id_foto', 'id_kategori_show');
    }
}
