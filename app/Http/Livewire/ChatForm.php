<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;

class ChatForm extends Component
{
    public $sender;
    public $receiver;
    public $message;
    public $users;
    

    public function mount(){
        $this->users = [];
                
        if(Auth::user()->role == 'applicant'){
            $this->users = User::where('role','!=','customer')->where('role','!=','admin')->get();
        }else{
            $this->users = User::all();
        }

        $this->sender = Auth::user()->id;
        $this->message = "";
        $this->receiver = "";

    }

    public function render()
    {
        return view('livewire.chat-form');
    }

    public function sendMessage(){
        $this->validate([
            'sender' => ['required', 'integer'],
            'receiver' => ['required', 'integer'],
            'message' => ['required'],
        ]);

        Message::create([
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'message' => $this->message
        ]);

        $this->emit("sendedMessage");
        $this->emit("receivedMessage",[$this->message,$this->sender, $this->receiver]);
        
    }
}
