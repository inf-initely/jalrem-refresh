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
                'nama_lokasi_english' => 'Aceh',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Bali',
                'nama_lokasi_english' => 'Bali',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Banten',
                'nama_lokasi_english' => 'Banten',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Bengkulu',
                'nama_lokasi_english' => 'Bengkulu',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'DI Yogyakarta',
                'nama_lokasi_english' => 'DI Yogyakarta',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'DKI Jakarta',
                'nama_lokasi_english' => 'DKI Jakarta',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Gorontalo',
                'nama_lokasi_english' => 'Gorontalo',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Jambi',
                'nama_lokasi_english' => 'Jambi',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Jawa Barat',
                'nama_lokasi_english' => 'West Java',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Jawa Tengah',
                'nama_lokasi_english' => 'Central Java',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Jawa Timur',
                'nama_lokasi_english' => 'Central Java',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Kalimantan Barat',
                'nama_lokasi_english' => 'West Kalimantan',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Kalimantan Selatan',
                'nama_lokasi_english' => 'South Kalimantan',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Kalimantan Tengah',
                'nama_lokasi_english' => 'Central Kalimantan',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Kalimantan Timur',
                'nama_lokasi_english' => 'East Kalimantan',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Kalimantan Utara',
                'nama_lokasi_english' => 'North Kalimantan',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Kepulauan Bangka Belitung',
                'nama_lokasi_english' => 'Bangka Belitung Islands',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Kepulauan Riau',
                'nama_lokasi_english' => 'Riau Islands',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Lampung',
                'nama_lokasi_english' => 'Lampung',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Maluku',
                'nama_lokasi_english' => 'Maluku',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Maluku Utara',
                'nama_lokasi_english' => 'North Maluku',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Nusa Tenggara Barat',
                'nama_lokasi_english' => 'West Nusa Tenggara',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Papua',
                'nama_lokasi_english' => 'Papua',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Papua Barat',
                'nama_lokasi_english' => 'West Papua',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Riau',
                'nama_lokasi_english' => 'Riau',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Sulawesi Barat',
                'nama_lokasi_english' => 'West Sulawesi',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Sulawesi Selatan',
                'nama_lokasi_english' => 'South Sulawesi',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Sulawesi Tengah',
                'nama_lokasi_english' => 'West Nusa Tenggara',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Sulawesi Tenggara',
                'nama_lokasi_english' => 'Central Sulawesi',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Sulawesi Utara',
                'nama_lokasi_english' => 'North Sulawesi',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Sumatera Barat',
                'nama_lokasi_english' => 'West Sumatra',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Sumatera Selatan',
                'nama_lokasi_english' => 'South Sumatra',
                'created_at' => today(),
                'updated_at' => today()
            ],
            [
                'nama_lokasi' => 'Sumatera Utara',
                'nama_lokasi_english' => 'North Sumatra',
                'created_at' => today(),
                'updated_at' => today()
            ],

        ];
        DB::table('lokasis')->truncate();
        DB::table('lokasis')->insert($data);
    }
}
