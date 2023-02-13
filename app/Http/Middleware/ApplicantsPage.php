<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantsPage
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

    if(isset(Auth::user()->role)){
                switch(Auth::user()->role){
                    
                    case 'supervisor': 
                    case 'recruiter':
                    case 'customer':
                    case 'administrator': 
                        return $next($request);
                    break;
    
                    case 'applicant': 
                        if($request->isMethod('post') == true || $request->isMethod('put') == true){
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
