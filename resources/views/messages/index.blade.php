@extends('layouts.app')

@section('content')
    @auth
        <div class="{{ Auth::user()->role }} dashboard-content app__dashboard-content">
            <x-layout.title title="Messages"></x-layout.title>
            
            <div class="row h-100 messages-container">
                <div class="col-md-4 ">
                    <p>New message</p>
                    <br/>
                    @livewire('chat-form')
                </div>
                <div class="col-md-8">
                    @livewire('chat-list')
                </div>
                
            </div>

       
    @endauth
@endsection