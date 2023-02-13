<form action="{{ route($url.'.search') }}" data-filter="{{$url}}}" id="{{$url}}Filters" @if ($view == 'list') class="d-flex justify-content-between white-bg flex-wrap filter-form" @else class="filter-form" @endif method="POST">
    @csrf
    <input type="hidden" name="user" value="{{ Auth::user()->id }}">
    <input type="hidden" name="type" value="{{ $view }}">

    <div class="form-group">
        @if ($view != 'list')
            <p>Filter</p>
        @endif

        <label for="">Search</label>
        @if ($view != 'list')
            <input class="form-control" type="text" name="">
            <input type="hidden" name="filter" value="firstname">
        @else
            <div class="d-flex">
                <input class="form-control" type="text" name="">
                <select name="filter" id="" class="form-control">
                    <option value="firstname">First Name</option>
                    <option value="lastname">Last Name</option>
                    <option value="title">Title</option>
                    <option value="email">Email</option>
                    <option value="phone">Phone</option>
                    <option value="location">Location</option>
                    <option value="english">English</option>
                </select>
            </div>
        @endif

    </div>
    <div @if ($view == 'list') class="d-flex" @endif>
        @if (Auth::user()->role == 'customer')
            <div class="form-group position-group">
                <label for="">Position</label>
                <div>
                    <select name="position" id="" class="form-control">
                        <option value="all">All</option>
                        @foreach ($positions as $position)
                            @if ($position->user->id == Auth::user()->id)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if (Auth::user()->role == 'supervisor')
            <div class="form-group checkbox-group state-group">
                <label>State</label>
                <div @if ($view == 'list') class="d-flex" @endif>
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
                        <label class="container">All
                            <input type="checkbox" checked name="all" id="" class="third">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
        @endif
        @if (Auth::user()->role == 'supervisor' || Auth::user()->role == 'recruiter')
            <div class="form-group checkbox-group matches-group">
                <label>Matches</label>
                <div @if ($view == 'list') class="d-flex" @endif>
                    <div class="checkbox">
                        <label class="container">Selected
                            <input type="checkbox" name="match" class="first">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label class="container">No Chosen
                            <input type="checkbox" name="nomatch" class="second">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label class="container">All
                            <input type="checkbox" name="all" checked id="third">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
        @endif
        <div class="form-group checkbox-group sort-group">
            @if ($view != 'list')
                <p>Sort by</p>
            @else
                <label>Sort by</label>
            @endif

            <div @if ($view == 'list') class="d-flex" @endif>
                <div class="checkbox">
                    <label class="container">Most Recent
                        <input type="checkbox" checked name="desc" id="" class="first">
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
</form>
