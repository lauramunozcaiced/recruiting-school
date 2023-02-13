<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function search(Request $request)
    {
        $users = User::where('role','!=','customer')->where('role','!=','applicant')
        ->where($request->get('filter'),'like','%'.$request->get('text').'%')
        ->orderBy('created_at',$request->get('sort'))
        ->get();

        return view("components.users.list", compact('users'))->render();
    }

    public function index()
    {
        $users = User::where('role','!=','customer')->where('role','!=','applicant')->orderBy('created_at','desc')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {       
        if($request->password != '') {
            User::find($user)->toQuery()->update([
                'name' => $request->name,
                'email' => $request->email,
                'role'=>$request->role,
                'password' => Hash::make($request->password),
            ]);
        }else{
            User::find($user)->toQuery()->update([
                'name' => $request->name,
                'email' => $request->email,
                'role'=>$request->role,
            ]);
        }
     
        
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);       
        Storage::deleteDirectory($user->role.'s/'.($user->role == 'applicant' ? $user->identification : $user->email));
        
        User::destroy($id);

        return redirect()->route('users.index');
    }
}
