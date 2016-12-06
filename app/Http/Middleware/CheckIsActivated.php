<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckIsActivated
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
        
        if(Auth::check()){

            $exceptUrl = array('home','editpersonal/changepassword','logout','checkpassword','postpassword');
            foreach($exceptUrl as $exc)
            {
                if($request->is($exc)){
                    return $next($request);
                } 
            }
            
            if(!Auth::user()->isActivated){
                return redirect('/editpersonal/changepassword');
            }



        }
            
             
        
        

        return $next($request);
    }
}
