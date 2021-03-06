<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingCart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['customer_id', 'total_price'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'shopping_cart_id');
    }
}
