<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

use Session;

class CartItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {   
        $quantity = $request->input('quantity');
        $product = Product::find($id);
        $customer = Customer::where('user_id', Auth::id())->first();
        
        $shoppingCart = Session::get('shopping_cart', function () use($customer){
            if(! Auth::check())
            {
                $cart =  ShoppingCart::firstOrNew(
                    ['customer_id' => null]
                );
            }
            else
            {
                $cart =  ShoppingCart::firstOrCreate(
                    ['customer_id' => $customer->id,
                    'deleted_at' => null]
                );
              
            }
            Session::forget('cart_items');
       
            Session::put('shopping_cart', $cart);
            return $cart;
        });


        $cartItems = Session::get('cart_items', function() use($shoppingCart) {
            if(Auth::check())
            {
                $products = $shoppingCart->cartItems(); 
                if($products)
                {
                    foreach($products as $product)
                    {
                        
                        $insertedProducts[$product->product_id] = Product::find($product->product_id);
                    }
                }
            }
            return Session::get('cart_items', []);
        });
       
        if(!Session::has('cart_items'))
        {
            Session::put('cart_items', []);   
           
        }
        
        $insertedProducts = Session::get('cart_items', []);
        
        $newItem = Arr::pull($insertedProducts,  $id, function () use($shoppingCart, $product) {
           
            return  CartItem::firstOrNew(
                ['shopping_cart_id' => $shoppingCart->id, 'product_id' => $product->id],
                ['quantity' => 0, 'total_price' => 0, 'unit_price' => $product->price]
            );
        });
    
        $newItem->quantity = $quantity + $newItem->quantity;
        $newItem->total_price = $newItem->quantity * $newItem->unit_price;
        $insertedProducts[$newItem->product_id] = $newItem;
        Session::put('cart_items', $insertedProducts);


        if(Auth::check())
        {
            if(!$newItem->shopping_cart_id)
            {
                $newItem->shopping_cart_id = $shoppingCart->id;
            }
            
            $newItem->save();
        }
       
        $request->session()->flash('message', 'Added to the sopping cart.');
        return redirect('products/'.$id);
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartItem $item, $id)
    {   
   
        if(Auth::check())
        {
            $item->delete();
        }
        
        $insertedProducts = Session::get('cart_items', []);
       
        unset($insertedProducts[$id]);
        Session::forget('cart_items');
        Session::put('cart_items', $insertedProducts);
       
        return redirect('/shopping_cart');
    }
}
