<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $source = $this->faker->randomElement(['led_detail.png', 'electronics_arduino_diy.png']);
        return [
            'image_source' => md5($source),
            'original_name' => $source
        ];
    }
}
