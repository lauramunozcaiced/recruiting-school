@extends('layouts.simple')

@section('content')
    <div class="login" style="background-image: url('{{ asset('./images/bg2.png') }}')">
        <div class="row justify-content-center h-100">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="container" id="container">
                    <div class="form-container sign-up-container">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="sign-up-container-header">
                                <h1>Sign Up</h1>
                                <span>Use your data for registration</span>
                            </div>
                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="{{ __('E-mail Address') }}"
                                    required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    placeholder="{{ __('Password') }}" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required
                                    autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="form-container sign-in-container">
                        <form method="POST" action="{{ route('login') }}">
                            <div class="sign-in-container-header">
                                <h1>Sign In</h1>
                                <span>Use your credentials for login</span>
                            </div>
                            @csrf

                            <div class="form-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="{{ __('E-mail Address') }}" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="{{ __('Password') }}" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check text-right">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                @if (Route::has('password.request'))
                                    <a class="btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>


                            </div>
                        </form>
                    </div>
                    <div class="overlay-container">
                        <div class="overlay">
                            <div class="overlay-panel overlay-left">
                                <img class="logo" src="{{ asset('./images/logo-white.png') }}" />
                                <div>
                                    <h4>Hey friend,</h4>
                                    <h1>Welcome Back</h1>
                                    <p>If you already have an account on Solvo Recruiting,
                                        go to login.</p>
                                    <button class="btn btn-outline-light" id="signIn">Sign In here</button>
                                </div>
                            </div>
                            <div class="overlay-panel overlay-right">
                                <img class="logo" src="{{ asset('./images/logo-white.png') }}" />
                                <div>
                                    <h4>Welcome to</h4>
                                    <h1>Solvo Recruiting</h1>
                                    <p>Not yet part of Solvo Global? Go to register and apply for one
                                        of our positions. Solvo is waiting for you. </p>
                                    <button class="btn btn-outline-light" id="signUp">Register here</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
