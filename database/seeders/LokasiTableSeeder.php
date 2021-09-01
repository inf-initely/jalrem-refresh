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
                'nama_lokasi' => 'Aceh',
                'nama_lokasi_english' => 'Aceh'
            ],
            [
                'nama_lokasi' => 'Bali',
                'nama_lokasi_english' => 'Bali'
            ],
            [
                'nama_lokasi' => 'Banten',
                'nama_lokasi_english' => 'Banten'
            ],
            [
                'nama_lokasi' => 'Bengkulu',
                'nama_lokasi_english' => 'Bengkulu'
            ],
            [
                'nama_lokasi' => 'DI Yogyakarta',
                'nama_lokasi_english' => 'DI Yogyakarta'
            ],
            [
                'nama_lokasi' => 'DKI Jakarta',
                'nama_lokasi_english' => 'DKI Jakarta'
            ],
            [
                'nama_lokasi' => 'Gorontalo',
                'nama_lokasi_english' => 'Gorontalo'
            ],
            [
                'nama_lokasi' => 'Jambi',
                'nama_lokasi_english' => 'Jambi'
            ],
            [
                'nama_lokasi' => 'Jawa Barat',
                'nama_lokasi_english' => 'West Java'
            ],
            [
                'nama_lokasi' => 'Jawa Tengah',
                'nama_lokasi_english' => 'Central Java'
            ],
            [
                'nama_lokasi' => 'Jawa Timur',
                'nama_lokasi_english' => 'Central Java'
            ],
            [
                'nama_lokasi' => 'Kalimantan Barat',
                'nama_lokasi_english' => 'West Kalimantan'
            ],
            [
                'nama_lokasi' => 'Kalimantan Selatan',
                'nama_lokasi_english' => 'South Kalimantan'
            ],
            [
                'nama_lokasi' => 'Kalimantan Tengah',
                'nama_lokasi_english' => 'Central Kalimantan'
            ],
            [
                'nama_lokasi' => 'Kalimantan Timur',
                'nama_lokasi_english' => 'East Kalimantan'
            ],
            [
                'nama_lokasi' => 'Kalimantan Utara',
                'nama_lokasi_english' => 'North Kalimantan'
            ],
            [
                'nama_lokasi' => 'Kepulauan Bangka Belitung',
                'nama_lokasi_english' => 'Bangka Belitung Islands',
            ],
            [
                'nama_lokasi' => 'Kepulauan Riau',
                'nama_lokasi_english' => 'Riau Islands',
            ],
            [
                'nama_lokasi' => 'Lampung',
                'nama_lokasi_english' => 'Lampung',
            ],
            [
                'nama_lokasi' => 'Maluku',
                'nama_lokasi_english' => 'Maluku',
            ],
            [
                'nama_lokasi' => 'Maluku Utara',
                'nama_lokasi_english' => 'North Maluku',
            ],
            [
                'nama_lokasi' => 'Nusa Tenggara Barat',
                'nama_lokasi_english' => 'West Nusa Tenggara'
            ],
            [
                'nama_lokasi' => 'Papua',
                'nama_lokasi_english' => 'Papua'
            ],
            [
                'nama_lokasi' => 'Papua Barat',
                'nama_lokasi_english' => 'West Papua'
            ],
            [
                'nama_lokasi' => 'Riau',
                'nama_lokasi_english' => 'Riau'
            ],
            [
                'nama_lokasi' => 'Sulawesi Barat',
                'nama_lokasi_english' => 'West Sulawesi'
            ],
            [
                'nama_lokasi' => 'Sulawesi Selatan',
                'nama_lokasi_english' => 'South Sulawesi'
            ],
            [
                'nama_lokasi' => 'Sulawesi Tengah',
                'nama_lokasi_english' => 'West Nusa Tenggara'
            ],
            [
                'nama_lokasi' => 'Sulawesi Tenggara',
                'nama_lokasi_english' => 'Central Sulawesi'
            ],
            [
                'nama_lokasi' => 'Sulawesi Utara',
                'nama_lokasi_english' => 'North Sulawesi'
            ],
            [
                'nama_lokasi' => 'Sumatera Barat',
                'nama_lokasi_english' => 'West Sumatra'
            ],
            [
                'nama_lokasi' => 'Sumatera Selatan',
                'nama_lokasi_english' => 'South Sumatra'
            ],
            [
                'nama_lokasi' => 'Sumatera Utara',
                'nama_lokasi_english' => 'North Sumatra'
            ],

        ];
        DB::table('lokasis')->insert($data);
    }
}
