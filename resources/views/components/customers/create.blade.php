<form method="POST" action="{{ route('customers.store') }}" class="white-bg" enctype="multipart/form-data">
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
    <div class="form-group">
        <label for="image">{{ __('Logo') }}</label>

        <div>
            <div class="avatar-visualization"></div>
            <input id="avatar" type="file" accept="image/jpg, image/jpeg, image/png"
                @error('image') is-invalid @enderror name="image" value="{{ old('image') }}"
                required>

            @error('image')
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
        <div>
            <input type="hidden" name="role" value="customer" required>
        </div>
    </div>

    <div class="form-group text-right">
        <div>
            <a class="btn btn-secondary rounded-0 mr-2" href="{{ route('customers.index') }}">Cancel</a>
            <button type="submit" class="btn bg-solvoblue text-white rounded-0">
                {{ __('Save') }}
            </button>
        </div>
    </div>
</form>
