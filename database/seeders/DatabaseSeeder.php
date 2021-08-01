<?php

namespace Database\Seeders;

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
        \App\Models\Lokasi::factory(1)->create();
        // \App\Models\KategoriShow::factory(1)->create();
        // \App\Models\KategoriShow::factory(1)->create([
        //     'isi' => 'Tampilkan di menu Jejak'
        // ]);
        // \App\Models\KategoriShow::factory(1)->create([
        //     'isi' => 'Tampilkan di menu Masa Depan'
        // ]);
        // \App\Models\KategoriShow::factory(1)->create([
        //     'isi' => 'Tampilkan di menu Kerjasama'
        // ]);
        // \App\Models\KategoriShow::factory(1)->create([
        //     'isi' => 'Tampilkan di menu Kegiatan'
        // ]);
    }
}
