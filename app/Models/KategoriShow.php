<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriShow extends Model
{
    use HasFactory;

    public function artikel()
    { 
        return $this->belongsToMany('App\Models\Artikel', 'artikel_kategori_show', 'id_kategori_show', 'id_artikel');
    }

}
