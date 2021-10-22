<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

class CreatedAtToPublishedAt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'created:published';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $artikels = DB::table('artikels')->get();
        foreach( $artikels as $a ) {
            DB::table('artikels')->where('id', $a->id)->update(['published_at'=> $a->created_at]);
        }
        $fotos = \App\Models\Foto::all();
        foreach( $fotos as $a ) {
            $a->update([
                'published_at' => $a->created_at
            ]);
        }
        $audio = \App\Models\Audio::all();
        foreach( $audio as $a ) {
            $a->update([
                'published_at' => $a->created_at
            ]);
        }
        $video = \App\Models\Video::all();
        foreach( $video as $a ) {
            $a->update([
                'published_at' => $a->created_at
            ]);
        }
        $publikasis = \App\Models\Publikasi::all();
        foreach( $publikasis as $a ) {
            $a->update([
                'published_at' => $a->created_at
            ]);
        }
        $kegiatan = \App\Models\Kegiatan::all();
        foreach( $kegiatan as $a ) {
            $a->update([
                'published_at' => $a->created_at
            ]);
        }
        $kerjasama = \App\Models\Kerjasama::all();
        foreach( $kerjasama as $a ) {
            $a->update([
                'published_at' => $a->created_at
            ]);
        }
        var_dump('oke');
        DB::commit();
        return 0;
    }
}
