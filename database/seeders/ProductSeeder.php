<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Image;
use App\Models\Parameter;
use App\Models\CategoryProduct;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory()
            ->count(25)
            ->has(Parameter::factory()->count(5))
            ->has(Image::factory()->count(3))
            ->create();

        foreach ($products as $product)
        {
            $category = CategoryProduct::create([
                'product_id' => $product->id,
                'category_id' => Category::all()->random()->id
            ]);
        }
    }
}
