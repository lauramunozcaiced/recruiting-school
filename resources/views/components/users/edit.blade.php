<form action="{{route('users.update', $user)}}" method="post" class="white-bg">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="name">Name</label><br>
        <input type="text" name="name" class="form-control" value="{{old('name', $user->name)}}" required>
        @error('name')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label><br>
        <small>Email can't be changed</small>
        <input type="email" name="" class="form-control" value="{{$user->email}}" disabled>
        <input type="hidden" name="email" class="form-control" value="{{$user->email}}" required>
        @error('email')
            <p class="error-message">{{$message}}</p>
        @enderror
    </div>
    <div @if (Auth::user()->id == $user->id) hidden @endif class="form-group">
        <label for="role">Role</label><br>
        <select name="role" class="form-control" required>
            <option @if ($user->role == 'administador') selected @endif value="administrator">Administrador</option>
            <option @if ($user->role == 'recruiter') selected @endif value="recruiter">Recruiter</option>
            <option @if ($user->role == 'supervisor') selected @endif value="supervisor">Supervisor</option>
            <option @if ($user->role == 'data entry') selected @endif value="data entry">Data Entry</option>
        </select>
        @error('role')
        <p class="error-message">{{$message}}</p>
    @enderror
    </div>
    <p class="mt-3 font-weight-bold">Change password</p>
    <div class="form-group mt-3">
        <label for="password">{{ __('New Password') }}</label>

        <div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group ">
        <label for="password-confirm">{{ __('Confirm Password') }}</label>

        <div>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                autocomplete="new-password">
        </div>
    </div>
    <div class="form-group text-right">
        <a class="btn btn-secondary rounded-0 mr-2" href="{{route('users.index')}}">Cancel</a>
        <button type="submit" class="btn bg-solvoblue rounded-0 text-white">Save</button>
</form>