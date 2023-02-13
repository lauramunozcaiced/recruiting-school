<form action="{{ route('positions.store') }}" method="post" class="white-bg">
    @csrf

    <div class="form-group">
        <label for="name">Name</label><br>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        @error('name')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Job Description</label><br>
        <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        @error('description')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="english">English Level</label><br>
        <select name="english" class="form-control" required>
            <option disabled selected>Choose an option</option>
            <option value="Beginner">Beginner</option>
            <option value="Elementary">Elementary</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Upper Intermediate">Upper Intermediate</option>
            <option value="Advanced">Advanced</option>
            <option value="Proficiency">Proficiency</option>
        </select>
        @error('english')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="salary">Salary</label><br>
        <input type="text" name="salary" class="form-control" value="{{ old('salary') }}" required>
        @error('salary')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="schedule">Schedule</label><br>
        <select name="schedule" class="form-control" required>
            <option selected value="full">Full Time</option>
            <option value="mid">Mid Time</option>
        </select>
        @error('schedule')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="timezone">Time Zone</label><br>
        <select name="timezone" class="form-control" required>
            <option value="AST (UTC-4)">AST (UTC-4)</option>
            <option selected value="EST (UTC-5)">EST (UTC-5)</option>
            <option value="CST">CST (UTC-6)</option>
            <option value="MST">MST (UTC-7)</option>
            <option value="PST">PST (UTC-8)</option>
            <option value="ALKS">ALKS (UTC-9)</option>
            <option value="HST">HST (UTC-10)</option>
            <option value="SST">SST (UTC-11)</option>
            <option value="ChST">ChST (UTC+10)</option>
        </select>
        @error('schedule')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="visible">State</label><br>
        <select name="visible" class="form-control" required>
            <option selected value="inactive">Inactive</option>
            <option value="active">Active</option>
        </select>
        @error('visible')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="user_id">Customer</label><br>
        <select name="user_id" class="form-control" required>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
        @error('user_id')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group text-right">
        <a class="btn btn-secondary rounded-0 mr-2" href="{{ route('positions.index') }}">Cancel</a>
        <button type="submit" class="btn bg-solvoblue rounded-0 text-white">Save</button>
</form>
