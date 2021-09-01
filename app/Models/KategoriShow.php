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

    public function foto()
    { 
        return $this->belongsToMany('App\Models\Foto', 'foto_kategori_show', 'id_kategori_show', 'id_foto');
    }

    public function audio()
    { 
        return $this->belongsToMany('App\Models\Audio', 'audio_kategori_show', 'id_kategori_show', 'id_audio');
    }

    public function video()
    { 
        return $this->belongsToMany('App\Models\Video', 'video_kategori_show', 'id_kategori_show', 'id_video');
    }

    public function publikasi()
    { 
        return $this->belongsToMany('App\Models\Publikasi', 'publikasi_kategori_show', 'id_kategori_show', 'id_publikasi');
    }

    public function kerjasama()
    { 
        return $this->belongsToMany('App\Models\Kerjasama', 'kerjasama_kategori_show', 'id_kategori_show', 'id_kerjasama');
    }

    public function kegiatan()
    { 
        return $this->belongsToMany('App\Models\Kegiatan', 'kegiatan_kategori_show', 'id_kategori_show', 'id_kegiatan');
    }

}
