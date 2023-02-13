<form method="POST" action="{{ route('users.store') }}" class="white-bg">
    @csrf
    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>

        <div>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="email">{{ __('E-Mail Address') }}</label>

        <div>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group ">
        <label for="password">{{ __('Password') }}</label>

        <div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

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
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
        </div>
    </div>

    <div class="form-group ">
        <label for="role">{{ __('Role') }}</label>

        <div>
            <select name="role" id="role" class="form-control" required>
                <option selected value="administrator">{{ __('Administrator') }}</option>
                <option value="recruiter">{{ __('Recruiter') }}</option>
                <option value="supervisor">{{ __('Supervisor') }}</option>
                <option value="data entry">{{ __('Data Entry') }}</option>
            </select>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group text-right">
        <div>
            <a class="btn btn-secondary mr-2 rounded-0" href="{{ route('users.index') }}">Cancel</a>
            <button type="submit" class="btn bg-solvoblue text-white rounded-0">
                {{ __('Save') }}
            </button>
        </div>
    </div>
</form>
