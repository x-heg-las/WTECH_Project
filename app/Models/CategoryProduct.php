<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'category_product';

    use HasFactory;
    protected $fillable = ['category_id', 'product_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
