<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nik' => $this->faker->unique()->numerify('################'),
            'nama_pengguna' => $this->faker->unique()->userName(),
            'nama' => $this->faker->name(),
            'no_telepon' => $this->faker->numerify('08##########'),
            'role' => 'Warga',
            'role_id' => 3,
            'password' => Hash::make('pass123'),
            'foto' => '',
            'is_delete' => 'N',
        ];
    }
}
