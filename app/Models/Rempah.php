<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

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

    public static function getAllQuery() {
        return Rempah::select(
            "id",
            "jenis_rempah as name_id",
            "jenis_rempah_english as name_en"
        );
    }

    public static function getDetailQuery(string $rempah) {
        return Rempah::select(
            "id",
            "jenis_rempah as name_id", "jenis_rempah_english as name_en",
            "keterangan as desc_id", "keterangan_english as desc_en"
        )
            ->where("jenis_rempah", $rempah)
            ->orWhere("jenis_rempah_english", $rempah);
    }
}
