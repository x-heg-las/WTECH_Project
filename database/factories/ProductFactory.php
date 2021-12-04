<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(10),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'stock' => $this->faker->randomNumber()
        ];
    }
}
