<div>
    <div class="tab" style="height: 80vh; overflow: auto;">
      <div class="tabcontent mt-2">
        <p>Inbox</p>
        @foreach ($messagesReceived as $received)
            <div class="mt-3 bg-light p-2">
                <div class="d-flex align-items-center">
                    <div class="bg-info text-center rounded-circle text-white" style="padding: .7rem 1rem;">
                        {{substr($received->senderUser->name,0,1)}}
                    </div>
                    <div class="pl-2">
                        <h5>{{$received->senderUser->name}}</h5>
                    </div>
                </div>
                <div class="pt-1 pl-5">
                    <span>{{$received->message}}</span>
                    <br/>
                    <small>{{$received->created_at}}</small>
                </div>
            </div>
            
        @endforeach
      </div>
      
      <div class="tabcontent mt-3">
        <p>Sent Messages</p>
        @foreach ($messagesSent as $sent)
        <div class="mt-3 bg-light p-2">
            <div class="d-flex align-items-center">
                <div class="bg-info text-center rounded-circle text-white" style="padding: .7rem 1rem;">
                    {{substr($sent->receiverUser->name,0,1)}}
                </div>
                <div class="pl-2">
                    <h5>{{$sent->receiverUser->name}}</h5>
                </div>
            </div>
            <div class="pt-1 pl-5">
                <span>{{$sent->message}}</span>
                <br/>
                <small>{{$sent->created_at}}</small>
            </div>
        </div>
            
        @endforeach
      </div>
    </div>
    
</div>
