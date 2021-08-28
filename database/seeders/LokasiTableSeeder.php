<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Lokasi;

class LokasiTableSeeder extends Seeder
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
                'nama_lokasi' => 'Aceh'
            ],
            [
                'nama_lokasi' => 'Bali'
            ],
            [
                'nama_lokasi' => 'Banten'
            ],
            [
                'nama_lokasi' => 'Bengkulu'
            ],
            [
                'nama_lokasi' => 'DI Yogyakarta'
            ],
            [
                'nama_lokasi' => 'DKI Jakarta'
            ],
            [
                'nama_lokasi' => 'Gorontalo'
            ],
            [
                'nama_lokasi' => 'Jambi'
            ],
            [
                'nama_lokasi' => 'Jawa Barat'
            ],
            [
                'nama_lokasi' => 'Jawa Tengah'
            ],
            [
                'nama_lokasi' => 'Jawa Timur'
            ],
            [
                'nama_lokasi' => 'Kalimantan Barat'
            ],
            [
                'nama_lokasi' => 'Kalimantan Selatan'
            ],
            [
                'nama_lokasi' => 'Kalimantan Tengah'
            ],
            [
                'nama_lokasi' => 'Kalimantan Timur'
            ],
            [
                'nama_lokasi' => 'Kalimantan Utara'
            ],
            [
                'nama_lokasi' => 'Kepulauan Bangka Belitung'
            ],
            [
                'nama_lokasi' => 'Kepulauan Riau'
            ],
            [
                'nama_lokasi' => 'Lampung'
            ],
            [
                'nama_lokasi' => 'Maluku'
            ],
            [
                'nama_lokasi' => 'Maluku Utara'
            ],
            [
                'nama_lokasi' => 'Nusa Tenggara Barat'
            ],
            [
                'nama_lokasi' => 'Nusa Tenggara Barat'
            ],
            [
                'nama_lokasi' => 'Papua'
            ],
            [
                'nama_lokasi' => 'Papua Barat'
            ],
            [
                'nama_lokasi' => 'Riau'
            ],
            [
                'nama_lokasi' => 'Sulawesi Barat'
            ],
            [
                'nama_lokasi' => 'Sulawesi Selatan'
            ],
            [
                'nama_lokasi' => 'Sulawesi Tengah'
            ],
            [
                'nama_lokasi' => 'Sulawesi Tenggara'
            ],
            [
                'nama_lokasi' => 'Sulawesi Utara'
            ],
            [
                'nama_lokasi' => 'Sumatera Barat'
            ],
            [
                'nama_lokasi' => 'Sumatera Selatan'
            ],
            [
                'nama_lokasi' => 'Sumatera Utara'
            ],

        ];
        DB::table('lokasis')->insert($data);
    }
}
