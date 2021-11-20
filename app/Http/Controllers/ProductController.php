<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
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
        // Show product detail page
        return view('layout.product_detail',compact('product', $product, 'gallery', $gallery, 'parameters', $parameters, 'request', $request));
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
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln($request);

        $out->writeln("-------------------------------------------------");

        $out->writeln($request->input('brand'));

        // Load search string
        $search = $request->input('search');

        // Find all products with request string in their name, order by sort
        if ($request->has('order_by')){
            $order_by = $request->input('order_by');
            $order = (string) $request->input('order');

            $products = Product::select("*")->where('name', 'ILIKE', "%{$search}%")->orderBy("{$order_by}", "{$order}")->paginate(10);
        } else {
            $products = Product::select("*")->where('name', 'ILIKE', "%{$search}%")->paginate(10);    
        }

        return view('layout.filter', compact('products',$products));
    }
}
