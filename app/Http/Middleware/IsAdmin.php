<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class IsAdmin
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
        $customer = Session::get('customer');

        if (Session::has('customer')){
            if (Session::get('customer')->is_admin){
                return $next($request);
            }
        }
        abort(403);
    }
}
