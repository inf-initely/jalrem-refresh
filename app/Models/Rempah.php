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
        return $this->belongsToMany('App\Models\Artikel', 'artikel_rempah', 'id_rempah', 'id_artikel');
    }

    public function foto()
    {
        return $this->belongsToMany('App\Models\Foto', 'foto_rempah', 'id_rempah', 'id_foto');
    }

    public function audio()
    {
        return $this->belongsToMany('App\Models\Audio', 'audio_rempah', 'id_rempah', 'id_audio');
    }

    public function video()
    {
        return $this->belongsToMany('App\Models\Video', 'video_rempah', 'id_rempah', 'id_video');
    }

    public function publikasi()
    {
        return $this->belongsToMany('App\Models\Publikasi', 'publikasi_rempah', 'id_rempah', 'id_publikasi');
    }

    public function kerjasama()
    {
        return $this->belongsToMany('App\Models\Kerjasama', 'kerjasama_rempah', 'id_rempah', 'id_kerjasama');
    }

    public function kegiatan()
    {
        return $this->belongsToMany('App\Models\Kegiatan', 'kegiatan_rempah', 'id_rempah', 'id_kegiatan');
    }
}
