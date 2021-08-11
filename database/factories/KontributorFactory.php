<?php

namespace Database\Factories;

use App\Models\Kontributor;
use Illuminate\Database\Eloquent\Factories\Factory;

class KontributorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kontributor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => 'Rahmat Hidayat H.M',
            'email' => 'rahmathidayathm@gmail.com',
            'domisili' => 'takalar',
            'atribusi' => 'atribusi',
            'kategori' => 'umum'
        ];
    }
}
