<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;

class CartItem extends Component
{

    public $item;
    public $product;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $this->item = $item;
        $this->product = Product::find($item->product_id)->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-item');
    }
}
