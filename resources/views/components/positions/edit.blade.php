<form action="{{ route('positions.update', $position) }}" method="post" class="white-bg">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="name">Name</label><br>
        <input type="text" name="name" class="form-control" value="{{ old('name', $position->name) }}" required>
        @error('name')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Job Description</label><br>
        <textarea name="description" class="form-control"
            required>{{ old('description', $position->description) }}</textarea>
        @error('description')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="english">English Level</label><br>
        <select name="english" class="form-control" required>
            <option @if ($position->english == 'Beginner') selected @endif
                value="Beginner">Beginner</option>
            <option @if ($position->english == 'Elementary') selected @endif value="Elementary">Elementary</option>
            <option @if ($position->english == 'Intermediate') selected @endif value="Intermediate">Intermediate</option>
            <option @if ($position->english == 'Upper Intermediate') selected @endif value="Upper Intermediate">Upper Intermediate
            </option>
            <option @if ($position->english == 'Advanced') selected @endif
                value="Advanced">Advanced</option>
            <option @if ($position->english == 'Proficiency') selected @endif value="Proficiency">Proficiency</option>
        </select>
        @error('english')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="visible">State</label><br>
        <select name="visible" class="form-control" required>
            <option @if ($position->visible == 'inactive') selected @endif
                value="inactive">Inactive</option>
            <option @if ($position->visible == 'active') selected @endif
                value="active">Active</option>
        </select>
        @error('visible')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="user_id">Customer</label><br>
        <select name="user_id" class="form-control" required>
            @foreach ($customers as $customer)
                <option @if ($position->user_id == $customer->id) selected @endif value="{{ $customer->id }}">
                    {{ $customer->name }}</option>
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
