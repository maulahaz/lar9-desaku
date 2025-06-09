<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Config;

class ConfigFactory extends Factory
{
    protected $model = Config::class;

    public function definition()
    {
        return [
            'key' => $this->faker->unique()->word,
            'value' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['text', 'number', 'boolean', 'file']),
            'description' => $this->faker->paragraph,
        ];
    }
}