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
        $this->info('Total data: ' .  $count);
    }
}
