<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Keuangan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Keuangan>
 */
class KeuanganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Keuangan::class;

    public function definition()
    {
        return [
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'jenis' => $this->faker->randomElement(['Pemasukan', 'Pengeluaran']),
            'kategori' => $this->faker->word,
            'jumlah' => $this->faker->numberBetween(10000, 1000000),
            'keterangan' => $this->faker->sentence,
        ];
    }
}
