<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
        \App\Models\Kontributor::factory(1)->create();
        // $data = [
        //     [
        //         'isi' => 'Jejak'
        //     ],
        //     [
        //         'isi' => 'Jalur'
        //     ],
        //     [
        //         'isi' => 'Masa Depan'
        //     ],
        //     [
        //         'isi' => 'Kerja Sama'
        //     ],
        //     [
        //         'isi' => 'Kegiatan'
        //     ],
        // ];
        // DB::table('kategori_shows')->insert($data);

        $this->call([
            LokasiTableSeeder::class,
            KategoriShowTableSeeder::class,
        ]);
    }
}
