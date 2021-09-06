<?php

namespace App\Console\Commands;

use App\Models\Artikel;
use App\Models\Audio;
use App\Models\Foto;
use App\Models\Kegiatan;
use App\Models\Kerjasama;
use App\Models\Publikasi;
use App\Models\Video;
use Carbon\Carbon;
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
    protected $description = 'Clean old data that have no relation or already deleted from the main table but still exist in relation table';

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
        DB::beginTransaction();
        $count = 0;
        //artikel kategori show
        $artikel_kategori_show = DB::table('artikel_kategori_show')->get();
        foreach ($artikel_kategori_show as $artikel) {
            DB::table('artikel_kategori_show')->where('id', $artikel->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            try {
                if (!Artikel::where('id', $artikel->id_artikel)->exists()) {
                    DB::table('artikel_kategori_show')->where('id_artikel', $artikel->id_artikel)->delete();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        $this->info('Total data artikel_kategori_show: ' .  $count);

        $count = 0;

        //foto kategori show
        $foto_kategori_show = DB::table('foto_kategori_show')->get();
        foreach ($foto_kategori_show as $foto) {
            DB::table('foto_kategori_show')->where('id', $foto->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            try {
                if (!Foto::where('id', $foto->id_foto)->exists()) {
                    DB::table('foto_kategori_show')->where('id_foto', $foto->id_foto)->delete();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        $this->info('Total data foto_kategori_show: ' .  $count);

        $count  = 0;

        //audio kategori show
        $audio_kategori_show = DB::table('audio_kategori_show')->get();
        foreach ($audio_kategori_show as $audio) {
            DB::table('audio_kategori_show')->where('id', $audio->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            try {
                if (!Audio::where('id', $audio->id_audio)->exists()) {
                    DB::table('audio_kategori_show')->where('id_audio', $audio->id_audio)->delete();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        $this->info('Total data audio_kategori_show: ' .  $count);

        $count = 0;

        //video kategori show
        $video_kategori_show = DB::table('video_kategori_show')->get();
        foreach ($video_kategori_show as $video) {
            DB::table('video_kategori_show')->where('id', $video->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            try {
                if (!Video::where('id', $video->id_video)->exists()) {
                    DB::table('video_kategori_show')->where('id_video', $video->id_video)->delete();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        $this->info('Total data video_kategori_show: ' .  $count);

        $count = 0 ;

        //publikasi kategori show
        $publikasi_kategori_show = DB::table('publikasi_kategori_show')->get();
        foreach ($publikasi_kategori_show as $publikasi) {
            DB::table('publikasi_kategori_show')->where('id', $publikasi->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            try {
                if (!Publikasi::where('id', $publikasi->id_publikasi)->exists()) {
                    DB::table('publikasi_kategori_show')->where('id_publikasi', $publikasi->id_publikasi)->delete();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        $this->info('Total data publikasi_kategori_show: ' .  $count);

        $count = 0;

        //kerjasama kategori show
        $kerjasama_kategori_show = DB::table('kerjasama_kategori_show')->get();
        foreach ($kerjasama_kategori_show as $kerjasama) {
            DB::table('kerjasama_kategori_show')->where('id', $kerjasama->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            try {
                if (!Kerjasama::where('id', $kerjasama->id_kerjasama)->exists()) {
                    DB::table('kerjasama_kategori_show')->where('id_kerjasama', $kerjasama->id_kerjasama)->delete();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        $this->info('Total data kerjasama_kategori_show: ' .  $count);

        $count = 0;

        //kegiatan kategori show
        $kegiatan_kategori_show = DB::table('kegiatan_kategori_show')->get();
        foreach ($kegiatan_kategori_show as $kegiatan) {
            DB::table('kegiatan_kategori_show')->where('id', $kegiatan->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            try {
                if (!Kegiatan::where('id', $kegiatan->id_kegiatan)->exists()) {
                    DB::table('kegiatan_kategori_show')->where('id_kegiatan', $kegiatan->id_kegiatan)->delete();
                    $count++;
                }
            } catch (\Throwable $th) {
                DB::rollback();
                $this->info('Delete data failed.', $th);
            }
        }

        $this->info('Total data kegiatan_kategori_show: ' .  $count);

        DB::commit();
    }
}
