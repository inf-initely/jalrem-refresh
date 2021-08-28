<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    public function artikel()
    {
        return $this->belongsTo('App\Models\Lokasi','id_lokasi', 'id');
    }
}
