@extends('layouts.app')

@section('content')
    @auth
        <div class="{{ Auth::user()->role }} dashboard-content app__dashboard-content">
            <x-layout.title title="Positions"></x-layout.title>
            <div class="view dashboard-view positions-view app__dashboard-view 
            @if(Auth::user()->role!='administrator' || Auth::user()->role=='data-entry') view__cards @else view_list @endif">
                <div class="row h-100">
                    <div class="col-md-12 col-lg-12 p-0 h-100 filter-container">
                        <p>Filters</p>
                        <x-positions.filter :customers="$customers"/>
                    </div>
                    <div class="col-md-12 col-lg-12 p-0 h-100">

                        @switch(Auth::user()->role)
                            @case('supervisor')
                            @case('recruiter')
                                <div class="view__cards dynamic-data">
                                    <x-positions.verification :positions="$positions" :customers="$customers" />
                                </div>
                            @break

                            @case('data entry')
                            @case('administrator')
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>Position Name</th>
                                            <th>English Level</th>
                                            <th>Description</th>
                                            <th>Customer</th>
                                            <th>State</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="dynamic-data">
                                        <x-positions.verification :positions="$positions" :customers="$customers"/>
                                    </tbody>
                                </table>

                                <!-- Create Modal -->
                                <button type="button" class="btn btn-primary position-create" data-toggle="modal"
                                    data-target="#createPosition"><i class="fa fa-plus"></i></button>

                                <div class="modal fade" id="createPosition" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>New Position</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <x-positions.create :customers="$customers" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @break

                            @default
                            <div class="view__cards dynamic-data">
                                <x-positions.verification :positions="$positions" :customers="$customers" />
                            </div>
                            @break
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
