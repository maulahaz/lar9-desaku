<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kematian;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kematian>
 */
class KematianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Kematian::class;

    public function definition()
    {
        return [
            'nik' => $this->faker->unique()->numerify('################'),
            'nama' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'tanggal_lahir' => $this->faker->date(),
            'tempat_lahir' => $this->faker->city,
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'alamat' => $this->faker->address,
            'tanggal_kematian' => $this->faker->date(),
            'waktu_kematian' => $this->faker->time(),
            'tempat_kematian' => $this->faker->randomElement(['Rumah', 'Rumah Sakit', 'Jalan Raya', 'Tempat Kerja', 'Lainnya']),
            'sebab_kematian' => $this->faker->sentence(3),
            'pendidikan' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3']),
            'profesi' => $this->faker->jobTitle,
            'ayah' => $this->faker->name('male'),
            'ibu' => $this->faker->name('female'),
        ];
    }
}
