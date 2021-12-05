<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {

        if($request->checkout)
        {
            $checkout = $request->checkout;
            //if the request is sent from shopping cart
            return view('auth.login', compact('checkout', $checkout));
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $sessionShoppingCart = Session::get('shopping_cart');
        $sesionCartItems = Session::get('cart_items');
        $request->session()->flush();
        $request->authenticate();
        $request->session()->regenerate();
      
       
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        Session::put('customer', $customer);

        if ($customer->is_admin){
            return redirect('/admin/dashboard');
        }

        if($request->checkout)
        {
            $shoppingCart = $customer->shoppingCart()->first();
            if($shoppingCart)
            {
                $shoppingCart->delete();
            }

            if(!$sessionShoppingCart)
            {
                return redirect()->intended(RouteServiceProvider::HOME);
            }

            
            $shoppingCart = $sessionShoppingCart;
            $shoppingCart->customer_id = $customer->id;
            $shoppingCart->save();
            
            foreach($sesionCartItems as $item) 
            {
                $item->shopping_cart_id = $shoppingCart->id;
                $item->save();
            }

            return redirect('/checkout/shipping');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Session::forget('cart_items');

        Session::forget('shopping_cart');

        Auth::guard('web')->logout();

        $request->session()->flush();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
