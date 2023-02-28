@extends('layouts.app')

@section('content')
    @auth
        <div class="{{ Auth::user()->role }} dashboard-content app__dashboard-content">
            <x-layout.title title="Messages"></x-layout.title>

            <div class="row h-100 messages-container dashboard-content m-0 p-0">
                <div class="col-md-3 m-0 p-0">
                    <x-messages.nav :mode="$mode" :users="$users"/>
                </div>
                <div class="col-md-9 p-4">
                    <div id="dynamic-messages">
                        <x-messages.inbox :messages="$messages" :mode="$mode" />
                    </div>
                </div>

            </div>
        @endauth
    @endsection
