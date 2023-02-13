@extends('layouts.app')

@section('content')
@auth
@if (Auth::user()->role != 'applicant' && Auth::user()->role != 'applicant')
    <div class="{{ Auth::user()->role }} dashboard-content app__dashboard-content">
        <x-layout.title title="Applicant"></x-layout.title>
       
            <div class="view dashboard-view applicants-view app__dashboard-view view__cards">
                <div class="row h-100">
                    <div class="col-md-12 col-lg-12 p-0 h-100 filter-container">
                        <p>Filters</p>
                        <x-applicants.filter :positions="$positions" url="{{ $url }}"></x-applicants.filter>
                    </div>
                    <div class="col-md-12 col-lg-12 p-0 h-100"
                        data-interval="false">
                        <div class="view__cards dynamic-data">
                            <x-applicants.verification :positions="$positions" :users="$users"
                                :applicants="$applicants" url="{{ $url }}" />
                        </div>
                    </div>
                </div>
            </div>
        

    </div>
    @endif
    @endauth
@endsection