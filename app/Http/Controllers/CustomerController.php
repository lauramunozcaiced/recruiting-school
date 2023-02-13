<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreCustomer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function search(Request $request){
        $users = User::where('role','customer')->where($request->get('filter'),'like','%'.$request->get('text').'%')
        ->orderBy('created_at',$request->get('sort'))->get();

        return view("components.customers.list", compact('users'))->render();
    }

    public function index(){
        $users = User::where('role','customer')->orderBy('created_at','desc')->get();
        return view('customers.index', compact('users'));
    }

    
    public function create(){
        return view('customers.create');
    }

    public function store(StoreCustomer $request){

        Storage::disk('public')->putFileAs('images/customers/'.$request->email.'/logo/', $request->image, 'logo.'.$request->image->extension());
        $path_logo =  'images/customers/'.$request->email.'/logo/logo.'.$request->image->extension();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'logo' => $path_logo
        ]);

        return redirect()->route('customers.index');
    }


    public function edit(User $customer){
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, User $customer){
        if($request->password != ''){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }else{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
        }
        
        
        $rou = '';
       
       if($request->roum != null && $request->image == null){
            $rou= $request->roum;
        }elseif($request->roum != null && $request->image != null){

            Storage::disk('public')->putFileAs('images/customers/'.$request->email.'/logo/', $request->image, 'logo.'.$request->image->extension());
            $rou =  'images/customers/'.$request->email.'/logo/logo.'.$request->image->extension();
            
        }elseif($request->roum == null && $request->image!= null){
           
            Storage::disk('public')->putFileAs('images/customers/'.$request->email.'/logo/', $request->image, 'logo.'.$request->image->extension());
            $rou =  'images/customers/'.$request->email.'/logo/logo.'.$request->image->extension();
           
        }

        if($rou != '' && $request->password != ''){
            User::find($customer)->toQuery()->update([
                'password' => Hash::make($request->password),
                'name' => $request->name,
                'logo' => $rou
            ]);
        }elseif($rou != '' && $request->password == ''){
            User::find($customer)->toQuery()->update([
                'name' => $request->name,
                'logo' => $rou
            ]);
        }else{
            User::find($customer)->toQuery()->update([
                'name' => $request->name,
            ]);
        }

        return redirect()->route('customers.index');
    }

    public function destroy($id){
        $user = User::find($id);
        if($user->role == 'customer'){
            Storage::deleteDirectory('images/'.$user->role.'s/'.$user->email);
        }
        User::destroy($id);
        
        return redirect()->route('customers.index');
    }
}
