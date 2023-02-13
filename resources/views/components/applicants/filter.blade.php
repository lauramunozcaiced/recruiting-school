@if(Route::currentRouteName() == 'applicants.index' || Route::currentRouteName() == 'applicants.search' || Route::currentRouteName() == 'preselections.index' )
<form class="filter-form" action="{{ route($url . '.search') }}" data-filter="{{ $url }}" id="{{ $url }}Filters" method="POST">
    @csrf
    <input type="hidden" name="user" value="{{ Auth::user()->id }}">

    <div class="d-flex w-100 justify-content-between flex-wrap">
        <div class="form-group">
            <label for="">Search</label>
            @if(Auth::user()->role != "administrator")
                <input class="form-control" type="text" name="" placeholder="Write Something...">
                <input type="hidden" name="filter" value="firstname">   
            @else
            <div class="d-flex align-items-end">
                <input class="form-control" type="text" name="" placeholder="Write Something...">
                <select name="filter" id="" class="form-control">
                    <option value="firstname">First Name</option>
                    <option value="lastname">Last Name</option>
                    <option value="identification">Identification</option>
                    <option value="title">Title</option>
                    <option value="email">Email</option>
                    <option value="phone">Phone</option>
                    <option value="location">Location</option>
                    
                </select>
            </div>
            @endif
        </div>
        <div class="d-flex">
        @if (Auth::user()->role == 'customer' || $url == 'preselections')
            <div class="form-group position-group">
                <label for="">Position</label>
                <div>
                    <select name="position" id="" class="form-control">
                        <option value="all">All</option>
                        @foreach ($positions as $position)
                             @if ($url == 'preselections')
                                <option value="{{ $position->id }}">{{ $position->name }} - {{$position->user->name}}</option>
                            @else
                                @if ($position->user->id == Auth::user()->id)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if (Auth::user()->role == 'supervisor' && $url == 'applicants')
            <div class="form-group checkbox-group state-group">
                <label>State</label>
                <div class="d-flex">
                    <div class="checkbox">
                        <label class="container">Active
                            <input type="checkbox" checked name="active" id="" class="first">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label class="container">Inactive
                            <input type="checkbox" name="inactive" id="" class="second">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label class="container">Hired
                            <input type="checkbox"  name="hired" id="" class="third">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label class="container">All
                            <input type="checkbox"  name="all" id="" class="fourth">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
        @endif
        @if ((Auth::user()->role == 'supervisor' || Auth::user()->role == 'recruiter') && $url == 'applicants')
            <div class="form-group checkbox-group matches-group">
                <label>My matches</label>
                <div class="d-flex">
                    <div class="checkbox">
                        <label class="container">Match
                            <input type="checkbox" name="match" class="first">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label class="container">No Match
                            <input type="checkbox" name="nomatch" class="second">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label class="container">All
                            <input type="checkbox" name="all" checked class="third">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
        @endif
        <div class="form-group checkbox-group sort-group">
            <label>Sort by</label>


            <div class="d-flex">
                <div class="checkbox">
                    <label class="container">Most Recent
                        <input type="checkbox" checked  name="desc" id="" class="first">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="checkbox">
                    <label class="container">Oldest
                        <input type="checkbox" name="asc" id="" class="second">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>
        </div>
    </div>
</form>
@else
<div style="background-color: #E9E9E9; padding: 1rem 0.8rem;">
<label style="">No filters. Only this applicant is shown, return to see all applicants.</label>
<a href="{{ route('applicants.index') }}">Return to all applicants</a>
</div>
@endif