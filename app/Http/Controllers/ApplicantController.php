<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreApplicant;
use App\Http\Requests\UpdateApplicant;
use App\Models\Applicant;
use App\Models\Position;
use App\Models\User;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Study;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{

    
public function search(Request $request){
        $applicants = Applicant::where($request->get('filter'),'like','%'. $request->get('text') .'%')
                                ->orderBy('created_at', $request->get('sort'))
                                ->with('skills','experiences','matches','preselections','evaluation');

        switch($request->get('matches')){
            case 'match': 
                $applicants = $applicants->whereHas('matches', function($query) use($request) {
                $query->where('user_id', $request->get('user'));
                });
            break;
            case 'nomatch':
                $applicants = $applicants->whereDoesntHave('matches', function($query) use($request) {
                    $query->where('user_id', $request->get('user'));
                });
            break;
        }

        if($request->get('pos') != '' && $request->get('pos') != 'all'){
            $applicants = $applicants->whereHas('matches', function($query) use($request) {
                $query->where('position_id', $request->get('pos'));
            });
        }

        if(Auth::user()->role != 'administrator' && $request->get('state') != 'all'){
            $applicants = $applicants->where('visible',$request->get('state'));
        }
        $users = User::where('role','supervisor')->orWhere('role', 'recruiter')->get();
        $positions = Position::where('visible','active')->with('user','matches')->get();
        $applicants = $applicants->get();     

        $url = 'applicants';
       return view("components.applicants.verification", compact('applicants','positions','users','url'))->render();
        
}

public function change(Request $request){
        $view = $request->view;
        return redirect()->route('applicants.index', compact('view'));
}


public function index(){         
        $user = Auth::user(); 

        $applicants = Applicant::with('skills','experiences','matches','preselections','evaluation')
        ->orderBy('created_at','desc')->get();
        $positions = Position::where('visible','active')->with('user','matches')->get();
        $users = User::where('role','supervisor')->orWhere('role', 'recruiter')->get();
        
        $url = 'applicants';

        if(Auth::user()->role == 'supervisor'){
            $applicants = $applicants->where('visible','active');
        }

        return view('applicants.index', compact('applicants','positions','users','url'));
}

public function show(Applicant $applicant){
    $applicants = array();
    array_push($applicants,$applicant);
    $positions = Position::where('visible','active')->with('user','matches')->get();
    $users = User::where('role','supervisor')->orWhere('role', 'recruiter')->get();
        
    $url = 'applicants';
    return view('applicants.show', compact('applicants','positions','users','url'));
}

public function store(StoreApplicant $request){  
    switch($request->step){
        case 1:
            
            Storage::disk('public')->putFileAs('images/applicants/'.$request->identification.'/avatar/', $request->image, 'avatar.'.$request->image->extension());
            $avatar =  'images/applicants/'.$request->identification.'/avatar/avatar.'.$request->image->extension();
            
            Storage::disk('public')->putFileAs('images/applicants/'.$request->identification.'/cv/', $request->cv, 'cv.'.$request->cv->extension());           
            $cv =  'images/applicants/'.$request->identification.'/cv/cv.'.$request->cv->extension(); 

            $applicant = Applicant::create([
                'identification' => $request->identification,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'image' => $avatar,
                'email' => $request->email,
                'phone' => $request->phone,
                'linkedin' => $request->linkedin,
                'cv'=> $cv,
                'location' => $request->location,
                'aboutme' => $request->aboutme,
                'title' => $request->title,
                'portfolio' => $request->portfolio,
                'english' => $request->english,
                'user_id' => Auth::user()->id,
            ]);

            Auth::user()->update([
                'name' => $request->firstname.' '.$request->lastname 
                 ]);
        break;

        case 2:
            foreach($request->skill as $skill){
                Skill::create([
                        'applicant_id' => Auth::user()->applicant->id,
                        'name' => $skill
                    ]);
            }
        break;
        
        case 3:
            foreach($request->study as $study){
                Study::create([
                        'applicant_id' => Auth::user()->applicant->id,
                        'title' => $study['title'],
                        'school' => $study['school'],
                        'graduated' => $study['graduated']
                    ]);
            }
        break;

        case 4:
            foreach($request->experience as $experience){
                Experience::create([
                        'applicant_id' => Auth::user()->applicant->id,
                        'position' => $experience['position'],
                        'company' => $experience['company'],
                        'start_date' => $experience['start_date'],
                        'end_date' => $experience['end_date'],
                        'description' => $experience['description']
                    ]);
            }
        break;

    } 

     return redirect('/'); 
 }


public function update(UpdateApplicant $request, Applicant $applicant){
    
    if(isset($request->visible)){
        $applicant->update(['visible' => $request->visible]);
        return redirect()->route('applicants.show',compact('applicant'));

    }else{ 
        switch($request->step){
            case 1:                
                if($request->image != null){
                    
                    Storage::disk('public')->putFileAs('images/applicants/'.$request->identification.'/avatar/', $request->image, 'avatar.'.$request->image->extension());
                    $avatar =  'images/applicants/'.$request->identification.'/avatar/avatar.'.$request->image->extension();
                    
                    $applicant->update([
                        'image' => $avatar,
                    ]);
            
                }
                if($request->cv != null){
                    Storage::disk('public')->putFileAs('images/applicants/'.$request->identification.'/cv/', $request->cv, 'cv.'.$request->cv->extension());           
                    $cv =  'images/applicants/'.$request->identification.'/cv/cv.'.$request->cv->extension(); 

                    $applicant->update([
                        'cv' => $cv,
                    ]);
                }
                
                Auth::user()->update([
                    'name' => $request->firstname.' '.$request->lastname
                ]);
            
                $applicant->update([
                    'identification' => $request->identification,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'linkedin' => $request->linkedin,
                    'location' => $request->location,
                    'aboutme' => $request->aboutme,
                    'title' => $request->title,
                    'portfolio' => $request->portfolio,
                    'english' => $request->english
                ]); 
            break;

            case 2:
                Skill::where('applicant_id',$applicant->id)->getQuery()->delete();
                foreach($request->skill as $skill){
                    Skill::create([
                            'applicant_id' => $applicant->id,
                            'name' => $skill
                        ]);
                }
            break;

            case 3:
                Study::where('applicant_id',$applicant->id)->getQuery()->delete();
                foreach($request->study as $study){
                    Study::create([
                        'applicant_id' => Auth::user()->applicant->id,
                        'title' => $study['title'],
                        'school' => $study['school'],
                        'graduated' => $study['graduated']
                    ]);
                }
            break;

            case 4: 
                Experience::where('applicant_id',$applicant->id)->getQuery()->delete();
                foreach($request->experience as $experience){
                    Experience::create([
                        'applicant_id' => $applicant->id,
                        'position' => $experience['position'],
                        'company' => $experience['company'],
                        'start_date' => $experience['start_date'],
                        'end_date' => $experience['end_date'],
                        'description' => $experience['description']
                    ]);
                }
            break;

            case 5:
                if($request->position_id != 0){
                    $applicant->update([
                        'position_id' => $request->position_id,
                        'choose_position' => $request->position_id
                ]);
                }else{
                    $applicant->update([
                        'choose_position' => $request->position_id,
                ]);
                }     
            break;

            case 6: 
                $applicant->update([
                    'video' => $request->video,
                ]);
            break;
        }   

        return redirect('/');
    }
       
}

public function destroy(Request $request, $id){

    $applicant = Applicant::find($id);
    
    Storage::deleteDirectory('images/applicants/'.$applicant->identification);
    Applicant::destroy($id);

    return redirect()->route('applicants.index');
}

}
