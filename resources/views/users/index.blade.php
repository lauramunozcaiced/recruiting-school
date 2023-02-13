@extends('layouts.app')

@section('content')
    @auth
        <div class="{{ Auth::user()->role }} dashboard-content app__dashboard-content">
            <x-layout.title title="Users"/>
            <div class="view dashboard-view positions-view app__dashboard-view  view_list">
                <div class="row h-100">
                    <div class="col-md-12 col-lg-12 p-0 h-100 filter-container">
                        <p>Filters</p>
                        <x-users.filter />
                    </div>
                    <div class="col-md-12 col-lg-12 p-0 h-100">
                        <div class="tableFixHead mt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th> 
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="dynamic-data">
                                    <x-users.list :users="$users"></x-users.list>    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary position-create" data-toggle="modal" data-target="#createUser"><i class="fa fa-plus"></i></button>
              
              <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h5>New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                    <div class="modal-body">             
                      <x-users.create />
                    </div>
                  </div>
                </div>
              </div>
        </div>
    @endauth
@endsection
