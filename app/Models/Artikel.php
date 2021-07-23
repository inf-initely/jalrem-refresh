<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'judul_indo', 'konten_indo', 'judul_english', 'konten_english', 'thumbnail'
    ];

    public function rempah()
    {
        return $this->belongsToMany('App\Models\Rempah', 'artikel_rempah', 'artikel_id', 'rempah_id');
    }
}
