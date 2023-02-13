<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreselectionsPage
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
        if(Auth::user()->role){
            switch(Auth::user()->role){
                
                case 'supervisor': 
                case 'recruiter':
                    return $next($request);
                break;

                case 'customer':
                    if($request->isMethod('post') == true || $request->isMethod('delete') == true){
                        return $next($request);
                        
                    }else{
                        return redirect('/'); 
                    }
                break;
                
                default:
                    return redirect('/');
                break;
            }
        }else{
            return redirect('/');
        }
    }
}
