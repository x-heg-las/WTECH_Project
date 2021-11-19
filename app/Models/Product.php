<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'stock'];

    public function images()
    {
        return DB::table('images')
                    ->where('product_id', '=', $this->id)
                    ->get();
    }

    public function thumbnail()
    {
        return DB::table('images')
                    ->where('product_id', '=', $this->id)
                    ->take(1)
                    ->get();
    }
}
