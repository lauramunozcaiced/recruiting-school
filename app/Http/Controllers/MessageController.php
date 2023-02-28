<?php

namespace App\Http\Controllers;

use App\Models\Message;
Use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMessage;
use App\Http\Requests\UpdateMessage;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mode = str_replace("/messages?","",$_SERVER["REQUEST_URI"]);
        $users; $messages;
        switch(Auth::user()->role){
            case 'customer':
            case 'applicant':
                $users = User::where(function ($query) {
                    $query->where('role','==','supervisor')
                    ->orWhere('role','==','recruiter');
                })->get();
            break;
            default:
            $users = User::all();
            break;
        }
        if($mode == 'inbox'){
            $messages = Message::where('receiver','=',Auth::user()->id)->with('senderUser','receiverUser')->orderBy('created_at', 'desc')->get();
        }else{
            $messages = Message::where('sender','=',Auth::user()->id)->with('senderUser','receiverUser')->orderBy('created_at', 'desc')->get();
        }

        return view('messages.index', compact('users','messages','mode'))->render();
    }

   
    public function reload(Request $request){
        $mode = $request->mode;
        $messages;

        if($mode == 'inbox'){
            $messages = Message::where('receiver','=',Auth::user()->id)->with('senderUser','receiverUser')->orderBy('created_at', 'desc')->get();
        }else{
            $messages = Message::where('sender','=',Auth::user()->id)->with('senderUser','receiverUser')->orderBy('created_at', 'desc')->get();
        }
        return view("components.messages.inbox", compact('messages','mode'))->render();
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessage $request)
    {
        $mode = $request->mode;
        $messages;
        Message::create([
            'receiver' => $request->receiver,
            'sender' => $request->sender,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        if($mode == 'inbox'){
            $messages = Message::where('receiver','=',Auth::user()->id)->with('senderUser','receiverUser')->orderBy('created_at', 'desc')->get();
        }else{
            $messages = Message::where('sender','=',Auth::user()->id)->with('senderUser','receiverUser')->orderBy('created_at', 'desc')->get();
        }
        return view("components.messages.inbox", compact('messages','mode'))->render();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        $users; 
        switch(Auth::user()->role){
            case 'customer':
            case 'applicant':
                $users = User::where(function ($query) {
                    $query->where('role','==','supervisor')
                    ->orWhere('role','==','recruiter');
                })->get();
            break;
            default:
            $users = User::all();
            break;
        }
        return view('messages.show', compact('message','users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
