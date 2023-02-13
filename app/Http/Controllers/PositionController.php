<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePosition; 
use App\Models\User;
use App\Models\Position;


class PositionController extends Controller
{
  
    public function search(Request $request){
        $positions = Position::where($request->get('filter'),'like','%'. $request->get('text') .'%')
        ->orderBy('created_at', $request->get('sort'))
        ->where('visible',$request->get('state'))
        ->with('user','matches');
          
        if($request->get('customer') != '' && $request->get('customer') != 'all'){
            $positions = $positions->where('user_id',$request->get('customer'));
        }
        $customers = User::where('role','customer')->has('positions')->get();
        $positions = $positions->get();  
        
        return view("components.positions.verification", compact('positions', 'customers'))->render();
    }
    
    public function index(){
        if(Auth::user()->role == 'customer'){
            $positions = Position::where('user_id',Auth::user()->id)->with('user','matches')->orderBy('created_at', 'desc')->get();
            $customers = User::where('id',Auth::user()->id)->where('role','customer')->with('positions')->has('positions')->get();
        }else{
            $positions = Position::with('user','matches')->orderBy('created_at', 'desc')->get();
            $customers = User::where('role','customer')->with('positions')->get();
        }
        
        
        return view('positions.index',compact('positions', 'customers'));
    }

   
    public function create(){
        $customers = User::all()->where('role','customer');
        return view('positions.create', compact('customers'));
    }

   
    public function store(StorePosition $request){
        Position::create($request->except('view'));

        return redirect()->route('positions.index');
    }

    
    public function show($id){
        
    }

    
    public function edit(Position $position){
        $customers = User::all()->where('role','customer');

        return view('positions.edit', compact('position', 'customers'));
    }

    public function update(StorePosition $request, Position $position){
        Position::find($position)->toQuery()->update($request->except('_method','_token','view'));
        return redirect()->route('positions.index');
    }

   
    public function destroy(Request $request, $id){
        Position::destroy($id);
        return redirect()->route('positions.index');
    }
}
