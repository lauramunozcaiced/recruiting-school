<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Applicant;
use App\Models\Position;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if(Auth::user()->role != 'applicant'){
            
            return redirect()->route('applicants.index');

        }else{
            $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );  
            $positions = Position::where('visible','active')->get();
            $locations = json_decode(file_get_contents(asset('js/cities.json'),false, stream_context_create($arrContextOptions)),true);
            return view('dashboard',compact('locations','positions'));
        }
        
    }
}
