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
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("------------------------------------------------------------------------------------------------");
        $out->writeln("EEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE");
        $out->writeln($customer);
        $out->writeln("------------------------------------------------------------------------------------------------");

        if (Session::has('customer')){
            if (Session::get('customer')->is_admin){
                return $next($request);
            }
        }
        abort(403);
    }
}
