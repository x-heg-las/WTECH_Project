<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use App\Models\CartItem;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Session;

class Counter extends Component
{

    public $quantity;
    public $item;
    public $product_id;

    protected $rules = [
        'quantity' => 'required|integer| min:1'
    ];

    public function mount($quantity, $item, $productID)
    {
        $this->quantity = $quantity;
        $this->item = $item;
        $this->product_id = $productID;
    }

    public function render()
    {
        return view('livewire.counter');
    }

    public function changeInDatabase()
    {
    
        $this->validate();
        if(Auth::check())
        {
            $record = CartItem::find($this->item);
            $record->quantity = $this->quantity;
            $record->total_price = $this->quantity * $record->unit_price;
            $record->save();
        }
        $cartItems = Session::get('cart_items');
        $item = Arr::pull($cartItems, $this->product_id);
        $item->quantity = $this->quantity;
        $item->total_price = $this->quantity * $item->unit_price;
        $cartItems[$item->product_id] = $item;

        Session::put('cart_items', $cartItems);
        $this->quantity = $item->quantity;
        $this->emit('set-price');
        redirect('/shopping_cart');
    }

    public function increment()
    {
        $this->validate();
       $this->quantity++;
       $this->changeInDatabase();

    }

    public function decrement()
    {
        $this->validate();
        if($this->quantity > 1)
        {
            $this->quantity--;
            $this->changeInDatabase();
        }
    }

}
