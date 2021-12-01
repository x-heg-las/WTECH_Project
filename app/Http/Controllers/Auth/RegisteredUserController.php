<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Customer;
use App\Models\ShoppingCart;

use Session;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {

        if($request->checkout)
        {
            if(Session::has('transfered_cart'))
            {
                Session::forget('transfered_cart');
            }
            
            if(Session::has('shopping_cart'))
            {
                Session::put('transfered_cart', Session::get('shopping_cart')); 
            }
        }
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $split_name = explode(" ", $request->name);

        if(count($split_name) < 2){
            array_push($split_name, null);
        }

        $customer = Customer::create([
            'first_name' => $split_name[0],
            'last_name' => $split_name[1],
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'user_id' => $user->id,
        ]);

        if(Session::has('transfered_cart'))
        {
            $cart = ShoppingCart::find(Session::get('transfered_cart')->id);
            $cart->customer_id = $customer->id;
            $cart->save();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
