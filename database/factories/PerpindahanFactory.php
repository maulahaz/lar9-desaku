<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Perpindahan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perpindahan>
 */
class PerpindahanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Perpindahan::class;

    public function definition()
    {
        return [
            'nik' => $this->faker->unique()->numerify('################'),
            'nama' => $this->faker->name,
            'alamat_asal' => $this->faker->address,
            'alamat_tujuan' => $this->faker->address,
            'tanggal_perpindahan' => $this->faker->date(),
            'jenis_perpindahan' => $this->faker->randomElement(['Dalam Negeri', 'Luar Negeri']),
            'sebab_perpindahan' => $this->faker->sentence,
        ];
    }
}
