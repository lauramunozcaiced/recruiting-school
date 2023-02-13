<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preselection;
use App\Models\Position;


class PreselectionController extends Controller
{
    public function search(Request $request){
        $view= $request->get('type');
        $preselections = Preselection::with('applicant','user','position')
        ->whereHas('applicant', function($query) use($request) {
            $query->where($request->get('filter'),'like','%'. $request->get('text') .'%');
        });
        
        if($request->get('pos') != 'all'){
            $preselections = $preselections->whereHas('position', function($query) use($request) {
            $query->where('id', $request->get('pos'));
        });
        }
        
        $preselections = $preselections->orderBy('created_at',$request->get('sort'))->get();
        $positions = Position::where('visible','active')->with('user','matches','preselections')->get();
        $users = new \ArrayObject();
        $applicants = new \ArrayObject();

        foreach($preselections as $preselection){
            //$positions->append($preselection->position);
            $users->append($preselection->user);
            $applicants->append($preselection->applicant);
        }

        $url = 'preselections';

       return view("components.applicants.verification", compact('applicants','positions','users','url'))->render();
    }
    public function index(){
        $preselections = Preselection::with('applicant','user','position')
        ->orderBy('created_at','desc')->get();

        $positions = Position::where('visible','active')->with('user','matches','preselections')->get();
        $users = new \ArrayObject();
        $applicants = new \ArrayObject();

        foreach($preselections as $preselection){
            //$positions->append($preselection->position);
            $users->append($preselection->user);
            $applicants->append($preselection->applicant);
        }
        
        $url = 'preselections';
        return view('preselections.index',compact('positions','users','applicants','url'));
    }


    public function store(Request $request){
        Preselection::create($request->except('view'));
        return redirect()->route('applicants.index');
    }

    public function destroy(Request $request,$id){

        $preselection = Preselection::where('applicant_id',$id)->first();
        Preselection::destroy($preselection->id);
        
        return redirect()->route('applicants.index');

    }
    
}
