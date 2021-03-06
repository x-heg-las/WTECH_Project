<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;
use App\Models\Image;


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
        $this->product = $item->product()->get()->first();
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

    public function thumbnail()
    {
        $thumbnail = Image::where('product_id', $this->product->id)->get()->first();
        if($thumbnail)
        {
            return $thumbnail->image_source;
        }
        else
        {
            return null;
        }
    }
}
