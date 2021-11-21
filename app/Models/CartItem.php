<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ShoppingCart;

class CartItem extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['product_id', 'quantity', 'total_price', 'unit_price', 'shopping_cart_id'];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function order()
    {
        return $this->hasOne(ShoppingCart::class, 'shopping_cart_id');
    }
}
