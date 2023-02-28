@extends('layouts.app')

@section('content')
    @auth
        <div class="{{ Auth::user()->role }} dashboard-content app__dashboard-content">
            <x-layout.title title="Messages"></x-layout.title>
            @php
                $mode = [];
                Auth::user()->id == $message->receiverUser->id ? array_push($mode, 'inbox') : false;
                Auth::user()->id == $message->senderUser->id ? array_push($mode, 'sent') : false;
            @endphp

            <div class="row h-100 messages-container dashboard-content m-0 p-0">
                <div class="col-md-3 m-0 p-0">
                    <x-messages.nav :mode="$mode[0]" :users="$users" />
                </div>
                <div class="col-md-9 p-4">
                    <div class="message">
                        <div class="d-flex">
                            <h4>{{ $message->subject }}</h4>
                            @foreach ($mode as $m)
                                <small class="bg-secondary p-1 ml-2" style="border-radius: 3px">{{ $m }}</small>
                            @endforeach
                        </div>
                        <div class="image__profile d-flex align-items-center mt-4">
                            <div class="userImage"
                                @if ($message->senderUser->logo != null) style="background-image: url('{{ asset($person->logo) }}');" 
                                @else style="background-image: url('{{ asset('/images/default-user-image.jpg') }}');" @endif>
                            </div>
                            <div style="margin-left: 15px">
                                <h5 >
                                    {{$message->senderUser->name}}
                                </h5>
                                @if ($mode[0] == 'inbox')
                                <p>to: me</p>
                                @else
                                <p>to: {{$message->receiverUser->name}}</p>
                                @endif
                                <small>{{ date_format($message->created_at,"F j, Y, g:i a") }}</small>
                            </div>      
                        </div>
                       <div class="bodyMessage mt-4 p-3">
                        {!!$message->message!!}
                       </div>

                       <div class="signMessage mt-5">
                        <div class="d-flex flex-wrap align-items-center">
                            <img src="{{asset('/images/logo-bgwhite.svg')}}" width="170"/>
                            <div class="pl-2">
                                <h5><strong>{{$message->senderUser->name}}</strong></h5>
                                <small class="text-uppercase">{{$message->senderUser->role}}</small>
                            </div>
                            
                        </div>
                        
                        <small><i>This message may contain confidential 
                            and/or privileged information. If you have received this 
                             message in error, please advise the sender immediately 
                             by reply e-mail and delete this message. 
                             Thank you for your cooperation</i></small>
                       </div>
                    </div>
                </div>

            </div>
        @endauth
    @endsection
