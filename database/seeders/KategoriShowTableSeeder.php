<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriShow;

class KategoriShowTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'isi' => 'Jejak'
            ],
            [
                'isi' => 'Jalur'
            ],
            [
                'isi' => 'Masa Depan'
            ],
            [
                'isi' => 'Kerja Sama'
            ],
            [
                'isi' => 'Kegiatan'
            ],
        ];
        DB::table('kategori_shows')->insert($data);
    }
}
