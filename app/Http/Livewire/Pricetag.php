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
        $this->pricetag = Session::get('shopping_cart')->cartItems()->sum('total_price');
    }

    public function render()
    {
        return view('livewire.pricetag');
    }
}
