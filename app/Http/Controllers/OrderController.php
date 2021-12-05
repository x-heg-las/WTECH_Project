<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShoppingCart;
use App\Models\CartItem;
use App\Providers\RouteServiceProvider;
use Session;

class OrderController extends Controller
{
 
    public function index(Request $request)
    {
        $items = Session::get('cart_items', []);

        if(Session::has('customer') && Session::has('shipping') && Session::has('payment'))
        {
            $customer = Session::get('customer');
            $shipping = Session::get('shipping');
            $payment = Session::get('payment');
            $sum = 0;

            if($items)
            {
                foreach($items as $item)
                {
                    $sum += $item->total_price;
                }
            }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("------------------------------------------------------------------------------------------------");
        $out->writeln($request);
        $out->writeln("------------------------------------------------------------------------------------------------");
        
        /*
        $request->validate([
            'customer_id' => 'required',
            'shopping_cart_id' => 'required',
        ]);
*/
        //$shopping_items = ShoppingCart::with('cartItems')->find($request->shopping_cart_id);      // Toto treba srpavit na jednu query!!!!!
        
        //$shopping_items = ShoppingCart::find($request->shopping_cart_id)->cartItems()->get();
        //$cart = ShoppingCart::find($request->shopping_cart_id);
        
        $shopping_items = Session::get('cart_items');
        $cart = Session::get('shopping_cart');

        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("------------------------------------------------------------------------------------------------");
        $out->writeln($shopping_items);
        $out->writeln("------------------------------------------------------------------------------------------------");


        $total_price = 0;

        foreach ($shopping_items as $item)
        {
            $total_price += $item->total_price;
        }
        
        //Create new Order
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total_price' => $total_price
        ]);
      
        foreach($shopping_items as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->total_price,
                'unit_price' => $item->unit_price
            ]);

            CartItem::destroy($item->id);
        }

        ShoppingCart::destroy($cart->id);
        Session::forget('shopping_cart');
        Session::forget('cart_items');

        $request->session()->flash('message', 'Order was succesfully created!');
        return redirect(RouteServiceProvider::HOME);
    }

}
