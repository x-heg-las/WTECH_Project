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
            'key' => $this->faker->randomElement(['Memory', 'Storage']),
            'text' => Str::random(10),
            'number' => $this->faker->randomNumber([1, 2,4, 8, 16, 32]),
            'units' => $this->faker->randomElement(['GB']),
            'product_id' => Product::all()->random()->id,
        ];
    }
}
