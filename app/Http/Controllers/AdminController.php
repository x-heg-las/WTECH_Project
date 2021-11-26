<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryProduct;
use Session;
use File;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Load all admins products
        $products = Session::get('customer')->products()->get();

        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("------------------------------------------------------------------------------------------------");
        $out->writeln($products);
        $out->writeln("------------------------------------------------------------------------------------------------");

        return view('layout.admin.index', compact('products', $products));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show create form.

        $categories = Category::all();

        return view('layout.admin.create', compact('categories', $categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln(Session::get('customer'));
        $out->writeln("------------------------------------------------------------------------------------------------");
        $out->writeln(Session::get('customer')->id);
        $out->writeln("------------------------------------------------------------------------------------------------");

        // Store new product.
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'customer_id' => Session::get('customer')->id
        ]);

        if ($request->category != 'empty'){
            $category = CategoryProduct::create([
                'category_id' => $request->category,
                'product_id' => $product->id
            ]);
        }

        $request->session()->flash('message', 'Product has been sucessfully created!');
        
        return redirect('/admin/dashboard');
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
        // Edit given product.
        $product_categories = $product->categories()->get();
        $categories = Category::all();
        return view('layout.admin.edit', compact('product', $product, 'product_categories', $product_categories, 'categories', $categories));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Update product with updated data.
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();
        $request->session()->flash('message', 'Product has been sucessfully updated!');
        
        return redirect('/admin/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("------------------------------------------------------------------------------------------------");
        $out->writeln($product);
        $out->writeln("------------------------------------------------------------------------------------------------");

        // Delete chosen product.
        $images = $product->images()->get();

        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("------------------------------------------------------------------------------------------------");
        $out->writeln($images);
        $out->writeln("------------------------------------------------------------------------------------------------");

        foreach($images as $image){
            $out->writeln($image);
            if(File::exists(public_path("images/{$image->image_source}"))){
                $out->writeln("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX");
                File::delete(public_path("images/{$image->image_source}"));
            }
            $image->delete();
        }

        $product->delete();

        $request->session()->flash('message', 'Product has been succesfully deleted!');
        return redirect('/admin/dashboard');
    }
}
