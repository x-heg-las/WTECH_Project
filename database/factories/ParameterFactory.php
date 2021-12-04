<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

class ParameterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key' => $this->faker->randomElement(['RAM', 'Memory', 'Storage', 'Brand']),
            'text' => Str::random(10),
            'number' => $this->faker->randomNumber(),
            'units' => $this->faker->randomElement(['MB', 'KB', 'GB', 'TB']),
            'product_id' => Product::all()->random()->id,
        ];
    }
}
