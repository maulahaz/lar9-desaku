<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Penduduk;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penduduk>
 */
class PendudukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Penduduk::class;

    public function definition()
    {
        return [
            'nik' => $this->faker->unique()->numerify('################'),
            'nama' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date('Y-m-d', '-18 years'),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'pendidikan' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3']),
            'profesi' => $this->faker->jobTitle,
            'alamat' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
