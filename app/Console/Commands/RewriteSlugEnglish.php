<?php

namespace App\Console\Commands;

use App\Models\Artikel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RewriteSlugEnglish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artikel:rewrite-slug-en';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generating slug english if english title is not null but slug is null/n-a';

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
        $artikels = Artikel::whereNotNull('judul_english')
                            ->orWhere('slug_english', 'n-a')
                            ->get();

        // open db transaction
        DB::beginTransaction();
        try {
            foreach ($artikels as $artikel) {
                $artikel->slug_english = empty($artikel->judul_english) ? null : generate_slug($artikel->judul_english, '-');
                $artikel->save();
            }

            //check if there are still artikels with slug_english is n-a, then rollback and generate info command failed
            if(Artikel::Where('slug_english', 'n-a')->exists()) {
                DB::rollback();
                $this->info('Rewrite slug english failed because there is still slug with n-a. check DB!');
            }
            // commit transaction
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
             DB::rollback();
            $this->info('Rewrite slug english failed.', $th);
        }

        $this->info('Rewrite slug english success. Total artikels: ' .  count($artikels));
    }
}
