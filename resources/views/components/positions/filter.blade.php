<form action="{{ route('positions.search') }}" data-filter="positions" id="positionsFilters"
    class="d-flex justify-content-between white-bg flex-wrap filter-form" method="POST">
    @csrf
    <input type="hidden" name="user" value="{{ Auth::user()->id }}">

    <div class="form-group">
        <label for="">Search</label>
        <div class="d-flex">
            <input class="form-control" type="text" name="">
            <select name="filter" id="" class="form-control">
                <option value="name">Position Name</option>
                <option value="english">English Level</option>
            </select>
        </div>
    </div>

    <div class="d-flex">
        @if (Auth::user()->role == 'customer')
        <div class="form-group customers-group">
            <input type="hidden" id="customerFilter" value="{{ Auth::user()->id }}">
        </div>
        @else
        <div class="form-group customers-group">
            <label>Company</label>
            <select class="form-control" name="" id="customerFilter">
                <option value="all">All</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        @if (Auth::user()->role == 'administrator')
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
                </div>
            </div>
        @endif

        <div class="form-group checkbox-group sort-group">
            <label>Sort by</label>
            <div class="d-flex">
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
