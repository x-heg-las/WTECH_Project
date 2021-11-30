<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\Parameter;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        $gallery = Image::where('product_id', $product->id)->get();
        $parameters = Parameter::where('product_id', $product->id)->get();
        $recent = $request->session()->get('recently_viewed', []);
        
        //Session remmembers only last 5 recently visited products
        if($recent && count($recent) > 4)
        {
           $index = array_key_first($recent);
           $request->session()->pull('recently_viewed.' . $index);;
        }
        
        if(!$recent || ($recent && !in_array($product, $recent)))
        {
            $request->session()->push('recently_viewed', $product);
        }
            

        // Show product detail page
        return view('layout.product_detail',compact('product', $product, 'gallery', $gallery, 'parameters', $parameters, 'request', $request, 'recent', $recent));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * Search products by their name.
     * 
     * @param \App\Http\Requests\UpdateProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // Load search string
        $search = $request->input('search');
        $products = Product::select("*")->where('name', 'ILIKE', "%{$search}%");

        if ($request->has('category')){

            $category = $request->input('category');

            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln("CCCCCCCCCCCCC----------------------------------------------------------------------------------");
            $out->writeln($category);
            $out->writeln("CCCCCCCCCCCCCC-------------------------------------------------------------------------------------");
            
            //$category = Category::where('name', $category)->first()->products()->get();

            $products = Product::whereHas('categories', function($q) use ($category) {
                $q->whereIn('name', $category);
            });
        }

        if ($request->has('memory')) {

            $memory = $request->input('memory');

            $products = $products->whereHas('parameters', function ($query) use ($memory) {
                $query->where('key', 'Memory')->whereIn('number', $memory);
            });
        }

        if ($request->has('storage')) {
            $storage = $request->input('storage');

            $products = $products->whereHas('parameters', function ($query) use ($storage) {
                $query->where('key', 'Storage')->whereIn('number', $storage);
            });

        }

        if ($request->has('min_price') and $request->input('min_price') != null) {
            $min_price = $request->input('min_price');
            
            $products = $products->where('price', '>=', $min_price);
        }

        if ($request->has('max_price') and $request->input('max_price') != null) {

            $max_price = $request->input('max_price');
            
            $products = $products->where('price', '<=', $max_price);
        }

        // Find all products with request string in their name, order by sort
        /*if ($request->has('order_by')){
            $order_by = $request->input('order_by');
            $order = (string) $request->input('order');

            $products = Product::select("*")->where('name', 'ILIKE', "%{$search}%")->orderBy("{$order_by}", "{$order}")->paginate(10);
        } else {
            $products = Product::select("*")->where('name', 'ILIKE', "%{$search}%")->paginate(10);    
        }*/

        if ($request->has('order_by')){
            $order_by = $request->input('order_by');
            $order = (string) $request->input('order');

            $products = $products->orderBy("{$order_by}", "{$order}");
        }

        $products = $products->paginate(10);

        return view('layout.filter', compact('products', $products));
    }
}
