<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerjasama extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rempahs()
    {
        return $this->belongsToMany('App\Models\Rempah', 'kerjasama_rempah', 'id_kerjasama', 'id_rempah');
    }

    public function kategori_show()
    { 
        return $this->belongsToMany('App\Models\KategoriShow', 'kerjasama_kategori_show', 'id_kerjasama', 'id_kategori_show');
    }
}
