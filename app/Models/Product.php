<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Customer;
use App\Models\CartItem;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'stock', 'customer_id'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function parameters()
    {
        return $this->hasMany(Parameter::class);
    }

    /**
     * The categories that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    /**
     * Person, who created product.
     */
    public function customer()
    {
        return $this->hasOne(Customer::class, 'customer_id');
    }

    public function cart_items()
    {
        return $this->belongsToMany(CartItem::class);
    }
}
