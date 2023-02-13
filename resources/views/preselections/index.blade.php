@extends('layouts.app')

@section('content') 
    @auth
    <div class="{{ Auth::user()->role }} dashboard-content app__dashboard-content">
        <x-layout.title title="Applicants Preselected"/>
       
            <div class="view dashboard-view applicants-view app__dashboard-view view__cards">
                <div class="row h-100">
                    <div class="col-md-12 col-lg-12 p-0 h-100 filter-container">
                        <p>Filters</p>
                        <x-applicants.filter :positions="$positions" url="preselections"></x-applicants.filter>
                    </div>
                    <div class="col-md-12 col-lg-12 p-0 h-100"
                        data-interval="false">
                        <div class="view__cards dynamic-data mt-3">
                            @if(count($applicants) != 0)
                            <x-applicants.verification :positions="$positions" :users="$users"
                                :applicants="$applicants" url="preselections" />
                            @else
                            <p>Nothing to show.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        

    </div>
    @endauth
@endsection
