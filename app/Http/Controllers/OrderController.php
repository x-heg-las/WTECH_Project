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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("------------------------------------------------------------------------------------------------");
        $out->writeln($request);
        $out->writeln("------------------------------------------------------------------------------------------------");

        $request->validate([
            'customer_id' => 'required',
            'shopping_cart_id' => 'required',
        ]);

        //$shopping_items = ShoppingCart::with('cartItems')->find($request->shopping_cart_id);      // Toto treba srpavit na jednu query!!!!!
        
        $shopping_items = ShoppingCart::find($request->shopping_cart_id)->cartItems()->get();
        $cart = ShoppingCart::find($request->shopping_cart_id);
        
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("------------------------------------------------------------------------------------------------");
        $out->writeln($shopping_items);
        $out->writeln("------------------------------------------------------------------------------------------------");

        
        //Create new Order
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total_price' => $cart->total_price
        ]);

        foreach($shopping_items as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->total_price,
                'unit_price' => $item->unit_price
            ]);

            $item->delete();
        }

        $cart->delete();

        

        $request->session()->flash('message', 'Order was succesfully created!');
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
