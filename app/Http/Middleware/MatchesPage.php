<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchesPage
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
        switch(Auth::user()->role){
                    
            case 'supervisor': 
            case 'recruiter':
                if($request->isMethod('post') == true || $request->isMethod('put') == true || $request->isMethod('delete')){
                    return $next($request);   
                }else{
                    return redirect('/'); 
                }
            break;

            default:
                return redirect('/');
            break;
        } 
    }
}
