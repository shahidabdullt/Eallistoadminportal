<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Adminmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
       
 
        // Perform action
       if(!Auth::check()){
         return redirect()->route('login')->with('error','please login first');
       }

       if(Auth::user()->isadmin !=1){
        return redirect()->route('login')->with('error','Acess denied');
       }

       return $next($request);
    //    $response->headers->set('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
    // $response->headers->set('Pragma', 'no-cache');
    // $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');

      //  return $response;
    }
}
