<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatList extends Component
{
    public $messagesReceived;
    public $messagesSent;
  
    

    protected $listeners = ["receivedMessage"];

    public function mount(){
        $this->messagesReceived = [];
        $this->messagesSent = [];
        $this->messagesReceived = Message::where('receiver','=',Auth::user()->id)->with('senderUser')->get();
        $this->messagesSent = Message::where('sender','=',Auth::user()->id)->with('receiverUser')->get();

    }

    public function receivedMessage($message){
        $this->messagesReceived = Message::where('receiver','=',Auth::user()->id)->with('senderUser')->get();
        $this->messagesSent = Message::where('sender','=',Auth::user()->id)->with('receiverUser')->get();
    }

    public function render()
    {
        return view('livewire.chat-list');
    }

    
}
