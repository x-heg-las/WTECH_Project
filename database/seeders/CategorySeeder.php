<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => "ESP32"],
            ['name' => "Arduino"],
            ['name' => "Raspberry_Pi"],
            ['name' => "Displays"],
            ['name' => "Sensors"],
            ['name' => "DIY"],
            ['name' => "SALE"],
            ['name' => "Powering"],
            ['name' => "Modules"]
        ];

        DB::table('categories')->insert($data);
    }
}
