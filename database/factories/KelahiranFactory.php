<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelahiran>
 */
class KelahiranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tempat_lahir' => $this->faker->city,
            // 'tanggal_lahir' => $this->faker->dateBetween('-1 years'),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            // 'tanggal_lahir' => $this->faker->date('Y-m-d', '-18 years'),
            'jam_lahir' => $this->faker->time('H:i'),
            'nama' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'panjang' => $this->faker->randomFloat(2, 45, 55), // cm
            'berat' => $this->faker->randomFloat(2, 2.5, 4.5), // kg
            'ayah' => $this->faker->name('male'),
            'ibu' => $this->faker->name('female'),
            'anak_ke' => $this->faker->numberBetween(1, 5),
            'jenis_kelahiran' => $this->faker->randomElement(['Normal', 'Caesar', 'Lainnya']),
            'penolong_kelahiran' => $this->faker->randomElement(['Dokter', 'Bidan', 'Dukun','Lainnya']),
        ];
    }
}
