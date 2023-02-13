<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicant;
use App\Models\Match;
use App\Models\Position;
use Carbon\Carbon;


class StatController extends Controller
{

    public function __invoke(Request $request)
    {
        return "Welcome to our homepage";
    }

    public function index()
    {
        
        if(Auth::user()->role != 'applicant'){
            $jobs = Position::where('visible','active')->get();
            Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);
        $applicants = Applicant::all();

        if(Auth::user()->role == 'customer'){
            
            $data = array(
                "applicants_this_week" => Applicant::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get(),
                "applicants_last_week" => Applicant::whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])->get(),
                "applicants_last_week_2" => Applicant::whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeekS(2), Carbon::now()->endOfWeek()->subWeeks(2)])->get(),
                "applicants_last_week_3" => Applicant::whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeekS(3), Carbon::now()->endOfWeek()->subWeeks(3)])->get(),
                "applicants_last_week_4" => Applicant::whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeekS(4), Carbon::now()->endOfWeek()->subWeeks(4)])->get(),
                "applicants_active_process" => Applicant::whereHas('preselections' , function($query){$query->where('user_id', Auth::user()->id); })->get(),
                "job_most_popular" => Position::where('user_id', Auth::user()->id )->with('matches')->get()
            );

        }else{
            $data = array(
                "applicants_this_week" => Applicant::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get(),
                "applicants_last_week" => Applicant::whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])->get(),
                "applicants_last_week_2" => Applicant::whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeekS(2), Carbon::now()->endOfWeek()->subWeeks(2)])->get(),
                "applicants_last_week_3" => Applicant::whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeekS(3), Carbon::now()->endOfWeek()->subWeeks(3)])->get(),
                "applicants_last_week_4" => Applicant::whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeekS(4), Carbon::now()->endOfWeek()->subWeeks(4)])->get(),
                "applicants_active_process" => Applicant::has('matches')->get(),
                "job_most_popular" => Position::all()
            );
        }
        

     
        

        return view('stats.index',compact('applicants','data','jobs'));

        }else{
           return false;
        }
        
    }
}
