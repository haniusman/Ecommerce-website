<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
           // print_r($this);
//die();
            if (Auth::user()->admin==1) {

                return $next($request);
            } else {
                // dd($request);
                return redirect('/');
            }

    }
}
