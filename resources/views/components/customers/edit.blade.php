<form action="{{ route('customers.update', $customer) }}" method="post" enctype="multipart/form-data" class="white-bg">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="name">Name</label><br>
        <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
        @error('name')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label><br>
        <small>Email can't be changed</small>
        <input type="email" name="" class="form-control" value="{{ $customer->email }}" disabled>
        <input type="hidden" name="email" class="form-control" value="{{ $customer->email }}" required>
        @error('email')
            <p class="error-message">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="image">Upload your Logo</label><br>
        <div class="d-flex mb-3">
            <div class="">
                <img id="img_avatar" src="{{ asset( $customer->logo) }}" alt="" style="width: 120px; height: 130px; object-fit: cover;">
            </div>
        <div class="avatar-visualization"></div>
        </div>
        <input type="file" id="avatar" name="image" accept="image/jpg, image/jpeg, image/png">
        <input type="hidden" name="roum" value="{{ $customer->logo }}">
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
        <a class="btn btn-secondary rounded-0 mr-2" href="{{ route('customers.index') }}">Cancel</a>
        <button type="submit" class="btn bg-solvoblue text-white rounded-0" >Save</button>
</form>
