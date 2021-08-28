<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rempah extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function artikel()
    {
        return $this->belongsToMany('App\Models\Rempah', 'artikel_rempah', 'id_rempah', 'id_artikel');
    }
}
