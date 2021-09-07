<?php

namespace App\Console\Commands;

use App\Models\Kegiatan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateTimestampKegiatan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kegiatan:update-timestamp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update kegiatan timestamp  based on new value';

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
        $this->info('Start changing timestamp');
        // data array of kegiatans contains id & new value of created-at
        $data = [
            [
                'judul' => 'Lomba Penulisan & Foto Bumi Rempah Nusantara untuk Dunia 2021: Kategori Pelajar',
                'timestamp' => '2021-07-30'
            ],
            [
                'judul' => 'Webinar Sosialisasi Lomba Foto, Penulisan, dan Vlog Jalur Rempah 2021',
                'timestamp' => '2021-07-30'
            ],
            [
                'judul' => 'Lomba Penulisan & Foto Bumi Rempah Nusantara untuk Dunia 2021: Kategori Wartawan & Umum',
                'timestamp' => '2021-07-30'
            ],
            [
                'judul' => '"Lomba Vlog Bumi Rempah Nusantara untuk Dunia 2021: Kategori Umum',
                'timestamp' => '2021-07-30'
            ]
        ];

        // open db transaction
        DB::beginTransaction();
        $count = 0;
        foreach($data as $item) {
            $kegiatan = Kegiatan::where('judul_indo', $item['judul']);

            // to update without triggering timestamp data update, we using update statement instead  of eloquent
            if($kegiatan) {
                try {
                    DB::table('kegiatans')
                    ->where('judul_indo', $item['judul'])
                    ->update([
                        'created_at' => $item['timestamp'],
                        'updated_at' => $item['timestamp']]
                    );
                    $count++;
                } catch (\Throwable $th) {
                    //throw $th;
                    DB::rollback();
                    $this->error('End changing stopped. Error:  '. $th->getMessage());
                }
            }
            else $this->info('There is no kegiatan with judul: ' . $item['judul']);
        }

        DB::commit();
        $this->info('End changing timestamp. Total data changed: ' . $count);
    }
}
