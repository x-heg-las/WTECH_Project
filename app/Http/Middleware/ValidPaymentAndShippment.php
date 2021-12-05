<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class ValidPaymentAndShippment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Session::has('payment'))
        {
            $request->session()->flash('message', "Choose payment method");
            return redirect()->back();
        }

        if(!Session::has('shipping'))
        {
            $request->session()->flash('message', "Choose shipping method!");
            return redirect()->back();
        }
        return $next($request);
    }
}
