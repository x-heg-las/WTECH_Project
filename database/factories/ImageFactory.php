<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use File;

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
        $timestamp = microtime(true);
        
        $old = file_get_contents(Storage::disk('local')->path('public/'.$source));
        $newPath = public_path('images/'.$timestamp.md5($source));
        file_put_contents($newPath, $old);
        return [
            'image_source' => $timestamp.md5($source),
            'original_name' => $source
        ];
    }
}
