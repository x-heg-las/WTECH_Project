<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use App\Models\CartItem;

class Counter extends Component
{

    public $quantity;
    public $item;

    protected $rules = [
        'quantity' => 'required|integer'
    ];

    public function mount($quantity, $item)
    {
        $this->quantity = $quantity;
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.counter');
    }

    public function changeInDatabase()
    {
    
        $this->validate();
        $record = CartItem::find($this->item);
        $record->quantity = $this->quantity;
        $record->total_price = $this->quantity * $record->unit_price;
        $record->save();
        $this->quantity = $record->quantity;
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
        $this->quantity--;
        $this->changeInDatabase();
    }

}
