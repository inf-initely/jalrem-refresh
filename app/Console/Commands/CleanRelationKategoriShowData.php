<?php

namespace App\Console\Commands;

use App\Models\Artikel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanRelationKategoriShowData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kategori-show:relation-clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean old data that have no relation or already deleted from the main table but sil exist in relation table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = 0;
        //artikel kategori show
        $artikel_kategori_show = DB::table('artikel_kategori_show')->get();
        foreach ($artikel_kategori_show as $artikel) {
            DB::beginTransaction();
            try {
                if (!Artikel::where('id', $artikel->id_artikel)->exists()) {
                    DB::table('artikel_kategori_show')->where('id_artikel', $artikel->id_artikel)->delete();
                    DB::commit();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        //foto kategori show
        $foto_kategori_show = DB::table('foto_kategori_show')->get();
        foreach ($foto_kategori_show as $foto) {
            DB::beginTransaction();
            try {
                if (!Artikel::where('id', $foto->id_foto)->exists()) {
                    DB::table('foto_kategori_show')->where('id_foto', $foto->id_foto)->delete();
                    DB::commit();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        //audio kategori show
        $audio_kategori_show = DB::table('audio_kategori_show')->get();
        foreach ($audio_kategori_show as $audio) {
            DB::beginTransaction();
            try {
                if (!Artikel::where('id', $audio->id_audio)->exists()) {
                    DB::table('audio_kategori_show')->where('id_audio', $audio->id_audio)->delete();
                    DB::commit();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        //video kategori show
        $video_kategori_show = DB::table('video_kategori_show')->get();
        foreach ($video_kategori_show as $video) {
            DB::beginTransaction();
            try {
                if (!Artikel::where('id', $video->id_video)->exists()) {
                    DB::table('video_kategori_show')->where('id_video', $video->id_video)->delete();
                    DB::commit();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }


        //publikasi kategori show
        $publikasi_kategori_show = DB::table('publikasi_kategori_show')->get();
        foreach ($publikasi_kategori_show as $publikasi) {
            DB::beginTransaction();
            try {
                if (!Artikel::where('id', $publikasi->id_publikasi)->exists()) {
                    DB::table('publikasi_kategori_show')->where('id_publikasi', $publikasi->id_publikasi)->delete();
                    DB::commit();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        //kerjasama kategori show
        $kerjasama_kategori_show = DB::table('kerjasama_kategori_show')->get();
        foreach ($kerjasama_kategori_show as $kerjasama) {
            DB::beginTransaction();
            try {
                if (!Artikel::where('id', $kerjasama->id_kerjasama)->exists()) {
                    DB::table('kerjasama_kategori_show')->where('id_kerjasama', $kerjasama->id_kerjasama)->delete();
                    DB::commit();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        //kegiatan kategori show
        $kegiatan_kategori_show = DB::table('kegiatan_kategori_show')->get();
        foreach ($kegiatan_kategori_show as $kegiatan) {
            DB::beginTransaction();
            try {
                if (!Artikel::where('id', $kegiatan->id_kegiatan)->exists()) {
                    DB::table('kegiatan_kategori_show')->where('id_kegiatan', $kegiatan->id_kegiatan)->delete();
                    DB::commit();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        
        $this->info('Total data: ' .  $count);
    }
}
