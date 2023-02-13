@extends('layouts.app')

@section('content')
    <div class="{{ Auth::user()->role }} dashboard-content app__dashboard-content">
    @if (Auth::user()->role == 'applicant')
       <x-applicants.dashboard :locations="$locations" :positions="$positions"/>
    @endif
    
    </div>
    
@endsection
