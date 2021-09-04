<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RempahUpdateTimestamp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rempah:update-timestamp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fixing timestamp null when initial data on the first create db';

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
        $this->info('Start fixing timestamp null');
        //open db transaction
        DB::beginTransaction();
        try {
            # table artikel_rempah
            $artikel_rempah = DB::table('artikel_rempah')->whereNull('created_at')->get();
            foreach ($artikel_rempah as $key => $value) {
                DB::table('artikel_rempah')->where('id', $value->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
            # table audio rempah
            $audio_rempah = DB::table('audio_rempah')->whereNull('created_at')->get();
            foreach ($audio_rempah as $key => $value) {
                DB::table('audio_rempah')->where('id', $value->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
            # table foto rempah
            $foto_rempah = DB::table('foto_rempah')->whereNull('created_at')->get();
            foreach ($foto_rempah as $key => $value) {
                DB::table('foto_rempah')->where('id', $value->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
            # table kegiatan rempah
            $kegiatan_rempah = DB::table('kegiatan_rempah')->whereNull('created_at')->get();
            foreach ($kegiatan_rempah as $key => $value) {
                DB::table('kegiatan_rempah')->where('id', $value->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
            # table kerjasama rempah
            $kerjasama_rempah = DB::table('kerjasama_rempah')->whereNull('created_at')->get();
            foreach ($kerjasama_rempah as $key => $value) {
                DB::table('kerjasama_rempah')->where('id', $value->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
            # table publikasi rempah
            $publikasi_rempah = DB::table('publikasi_rempah')->whereNull('created_at')->get();
            foreach ($publikasi_rempah as $key => $value) {
                DB::table('publikasi_rempah')->where('id', $value->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
            # table video rempah
            $video_rempah = DB::table('video_rempah')->whereNull('created_at')->get();
            foreach ($video_rempah as $key => $value) {
                DB::table('video_rempah')->where('id', $value->id)->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            $this->error('Error while fixing timestamp null', $th);
        }
        //commit db transaction
        DB::commit();
        $this->info('End fixing timestamp null');

    }
}
