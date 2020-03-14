@extends('layouts.auth')

@section('title') Login @endsection

@section('content')
<div class="card p-4">
    <div class="card-header text-center text-uppercase h4 font-weight-light">
        Login
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="card-body py-5">
            <div class="form-group">
                <label class="form-control-label" for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-control-label" for="password">{{ __('Password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="custom-control custom-checkbox mt-4">
                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary px-5">{{ __('Login') }}</button>
                </div>

                <div class="col-6">
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

