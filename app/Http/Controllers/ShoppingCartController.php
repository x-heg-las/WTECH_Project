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
use Session;

class ShoppingCartController extends Controller
{

    public function getCartIdFromSession()
    {
        $session = Session::has('shopping_cart') ? Session::get('shopping_cart') : null;
        
        if(Auth::check())
        {
            $customer = Customer::where('user_id', Auth::id())->first();

            $shopping_cart = ShoppingCart::where('customer_id' ,$customer->id)->first();

            if ($shopping_cart == null){
                $id = DB::table('shopping_carts')->insertGetId([
                    'customer_id' => $customer->id,
                ]);
                Session::put('shopping_cart', ShoppingCart::find($id));
                return $id;
            }

            else{
                return $shopping_cart->id;
            }
        }

        if($session)
        {
            return $session->id;
        }
       
        $id = DB::table('shopping_carts')->insertGetId([]);
        Session::put('shopping_cart', ShoppingCart::find($id));
        return $id;
    }

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
        $customer = $this->getCartIdFromSession();
        
        $items = ShoppingCart::find($customer)->cartItems()->get();
        $sum = $items->sum('total_price');

        return view('layout.shopping-cart', compact('items', $items, 'sum', $sum));
   
    }

    public function addToShoppingCart(Request $request, $id)
    {
        $cartId = $this->getCartIdFromSession();
        $quantity = $request->input('quantity');
        $product = Product::find($id);

        /*DB::table('cart_items')->insert(
            ['shopping_cart_id' => $cartId,
             'product_id' => $product->id,
             'quantity' => $quantity,
             'unit_price' => $product->price,
             'total_price' => $product->price * $quantity,
             ]
        );*/

        $new_item = CartItem::create(
            ['shopping_cart_id' => $cartId,
             'product_id' => $product->id,
             'quantity' => $quantity,
             'unit_price' => $product->price,
             'total_price' => $product->price * $quantity,
             ]
        );
        
        $request->session()->flash('message', 'Added to the sopping cart.');
        return redirect('products/'.$id);
    }

    public function addShippingData(Request $request)
    {
        /*                                              // vrat validaciu
        $request->validate([
            'first_name' => 'required|min:3|max:255',
            'last_name' => 'required|min:3|max:255',
            'street_and_number' => 'required|max:255',
            'city' => 'required',
            'zip_code' => 'required|min:5|max:5',
            'telephone' => 'regex:/^\+421[0-9]{9}/',
            'email' => 'regex:/^.+@.+$/i'
        ]);
        */

        $customer = Session::has('customer') ? Session::get('customer') : null;
        if(Auth::check())
        {
            $customer = Customer::find(Auth::id());
        }

        //len pre testovanie
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

        //pridaj priradenie nakupneho kosa k zakaznikovi

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
    {
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

        return view('layout.checkout-recap', compact('items', $items, 'customer', $customer));
    }

    public function choosePaymentMethod(Request $request)
    {
        $cartId = $this->getCartIdFromSession();
        $items = ShoppingCart::find($cartId)->cartItems()->get();
        $sum = $items->sum('total_price');

        return view('layout.checkout-pay', compact('items', $items, 'sum', $sum));
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
