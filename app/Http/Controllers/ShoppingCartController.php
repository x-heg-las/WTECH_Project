<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Customer;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Session;

class ShoppingCartController extends Controller
{

    public function getCartIdFromSession()
    {
        $customer = Session::has('shopping_cart') ? Session::get('shopping_cart') : null;
        
        if(Auth::check())
        {
            $customer = Customer::find('user_id', Auth::id())->id;
        }

        if($customer)
        {
         
            return ShoppingCart::find($customer->id)->id;
        
        }
       
        $id = DB::table('shopping_carts')->insertGetId([]);
        Session::put('shopping_cart', ShoppingCart::find($id));
        return $id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer = $this->getCartIdFromSession();
        
        $items = ShoppingCart::find($customer)->cartItems()->get();

        return view('layout.shopping-cart', compact('items', $items));
   
    }

    public function addToShoppingCart(Request $request, $id)
    {
        $cartId = $this->getCartIdFromSession();
        $product = Product::find($id);
        DB::table('cart_items')->insert(
            ['shopping_cart_id' => $cartId,
             'product_id' => $product->id,
             'quantity' => 1,
             'unit_price' => $product->price,
             'total_price' => $product->price
             ]
        );
        
        $request->session()->flash('message', 'Added to the sopping cart.');
        return redirect('products/'.$id);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check())
        {
            $user = Auth::id();
            
        }
        else
        {
            $user = Cache::get('id');
        }

        $cart = Customer::find($user)->shoppingCart;
        return redirect('/lauout.shopping-cart', compact('cart', $cart->find($cart->id)->get()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
