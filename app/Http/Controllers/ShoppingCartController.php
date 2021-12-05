<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Customer;
use App\Models\ShoppingCart;
use App\Models\CartItem;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Session;

class ShoppingCartController extends Controller
{

    public function changeOption(Request $request, $option, $value, $page)
    {
        if(Session::has($option))
        {
            Session::forget($option);
        }
       

        Session::put($option, $value);
       
        return redirect('/checkout/'.$page);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer = Customer::where('user_id', Auth::id())->first();

        $shoppingCart = Session::get('shopping_cart', function () use($customer){
            if(!Auth::check())
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
            $insertedProducts = [];
            if(Auth::check())
            {
                $products = $shoppingCart->cartItems()->get(); 
   
                if($products)
                {
                   
                    foreach($products as $product)
                    {   
                        $insertedProducts[$product->product_id] = $product;
                    }
                }
            }
            Session::put('cart_items', $insertedProducts);
            return Session::get('cart_items', []);
        });

       // $cartId = $this->getCartIdFromSession();
        //$items = ShoppingCart::find($cartId)->cartItems()->get();
        
        $items = Session::get('cart_items', []);
       
        $sum = 0;
        if($items)
        {
            
            foreach ($items as $item)
            {
    
                $sum += $item->total_price;
            }
        }
  
        return view('layout.shopping-cart', compact('items', $items, 'sum', $sum));
   
    }


    public function addShippingData(Request $request)
    {
        // vrat validaciu
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'street_and_number' => 'required|max:255',
            'city' => 'required',
            'zip_code' => 'required|min:5|max:5',
            'telephone' => 'regex:/^[0-9]{10}/',
            'email' => 'regex:/^.+@.+$/i'
        ]);
        
        
        $customer = Session::has('customer') ? Session::get('customer') : null;
        
        if(Auth::check())
        {
            $customer = Customer::where('user_id', Auth::id())->first();
      
        }

        if(!$customer)
        {
            $customer = Customer::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'telephone' => $request->telephone
            ]);
        }

        if(Session::has('customer'))
        {
            Session::forget('customer');
        }

        Session::put('customer', $customer);

        $address = Address::create([
            'customer_id' => $customer->id, 
            'street_and_number' => $request->street_and_number,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'country' => $request->country
        ]);

        return redirect('/checkout/payment');
    }

    public function removeFromShoppingCart($id)
    {
        CartItem::destroy($id);
        return redirect('/shopping_cart');
    }

    public function chooseShippingMethod(Request $request)
    {
        $customer = null;
        $address = null;
        if(Auth::user()) {
            $customer = Customer::with('address')->where('user_id', Auth::user()->id)->first();
            if ($customer -> address != null){
                $address = $customer->address;
            }
        }
       
        return view('layout.checkout-shipping', compact('customer', $customer, 'address', $address));
    }

    public function recapitulation()
    {/*
        $cartId = $this->getCartIdFromSession();
        $items = ShoppingCart::find($cartId)->cartItems()->get();

        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("------------------------------------------------------------------------------------------------");
        $out->writeln(Session::has('customer'));
        $out->writeln("------------------------------------------------------------------------------------------------");

        if(Session::has('customer') && Session::has('shipping') && Session::has('payment'))
        {
            $customer = Session::get('customer');
            $shipping = Session::get('shipping');
            $payment = Session::get('payment');
            $sum = $items->sum('total_price');

            return view('layout.checkout-recap',
            compact(
                'customer', $customer,
                'shipping',
                'payment',
                'items', $items,
                'sum'
            ));
        }

        return view('layout.checkout-recap', compact('items', $items, 'customer', $customer));*/
    }

    public function choosePaymentMethod(Request $request)
    {
        $items = Session::get('cart_items', []);
        //$sum = $items->sum('total_price');
        $sum = 0;
        foreach($items as $item)
        {
            $sum += $item->total_price;
        }
        return view('layout.checkout-pay', compact('items', $items, 'sum', $sum));
    }

}
