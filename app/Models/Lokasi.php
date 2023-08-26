<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Lokasi extends Model
{
    use HasFactory;

    public function artikel()
    {
        return $this->belongsTo('App\Models\Lokasi','id_lokasi', 'id');
    }

    public static function getAllQuery() {
        return Lokasi::select("id", "nama_lokasi as name_id", "nama_lokasi_english as name_en", "latitude", "longitude");
    }
}
