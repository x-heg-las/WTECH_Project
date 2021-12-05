<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ShoppingCart;
use App\Models\CartItem;
use Session;

class Pricetag extends Component
{

    protected $listeners = ['set-price' => 'refreshPrice'];
    public $pricetag;
    public $cart;

    public function mount($price)
    {
        $this->pricetag = $price;
    }

    public function refreshPrice()
    {
        //$this->pricetag = Session::get('shopping_cart')->cartItems()->sum('total_price');

        $items = Session::get('cart_items');
        $sum = 0;
        foreach ($items as $item)
        {
            $sum += $item->total_price;
        }
        $this->pricetag = $sum;
    }

    public function render()
    {
        return view('livewire.pricetag');
    }
}
