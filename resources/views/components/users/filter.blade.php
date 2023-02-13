<form action="{{ route('users.search') }}" data-filter="users" id="usersFilters"
    class="d-flex justify-content-between white-bg flex-wrap filter-form" method="POST">
    @csrf
    <input type="hidden" name="user" value="{{ Auth::user()->id }}">
    
    <div class="form-group">
        <label for="">Search</label>
        <div class="d-flex">
            <input class="form-control" type="text" name="">
            <select name="filter" id="" class="form-control">
                <option value="name">Name</option>
                <option value="email">Email</option>
                <option value="role">Role</option>
            </select>
        </div>
    </div>
    <div class="d-flex">
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
