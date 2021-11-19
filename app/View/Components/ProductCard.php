<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;
use App\Models\Image;

class ProductCard extends Component
{

    public $record;
    public $gallery;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->record = $product;
        $this->gallery = Image::where('product_id', $product->id)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-card');
    }
}
