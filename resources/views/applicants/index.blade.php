@extends('layouts.app')

@section('content')
    @auth
        @if (Auth::user()->role == 'applicant')
            @php
                header('Location: ' . URL::to('/'), true, 302);
                exit();
            @endphp
        @elseif(Auth::user()->role != 'applicant')
            <div class="{{ Auth::user()->role }} dashboard-content app__dashboard-content">
                <x-layout.title title="Applicants"></x-layout.title>
                <div class="view dashboard-view applicants-view app__dashboard-view @if(Auth::user()->role != 'administrator') view__cards @else view__list @endif">
                    <div class="row h-100">
                        <div class="col-md-12 col-lg-12 p-0 h-100 filter-container">
                            <p>Filters</p>
                            <x-applicants.filter :positions="$positions" url="{{ $url }}"></x-applicants.filter>
                        </div>
                        <div class="col-md-12 col-lg-12 p-0 h-100">
                        @if(Auth::user()->role != 'administrator')
                            <div class="view__cards dynamic-data mt-3">
                                @if (count($applicants) != 0)
                                    <x-applicants.verification :positions="$positions" :users="$users" :applicants="$applicants"
                                        url="{{ $url }}" />
                                @else
                                    <p>Nothing to show.</p>
                                @endif
                            </div>
                        @else
                        <div class="tableFixHead mt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="image">Image</th>
                                        <th class="name">Name</th>
                                        <th class="id">Identification</th>
                                        <th class="title">Title</th>
                                        <th class="email">Email</th>
                                        <th class="location">Location</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="dynamic-data">
                                    @if (count($applicants) != 0)
                                    <x-applicants.verification :positions="$positions" :users="$users" :applicants="$applicants"
                                        url="{{ $url }}" />
                                @else
                                    <p>Nothing to show.</p>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection
