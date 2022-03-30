@extends('components.credential-index')
@section('content')
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
        <p class="text-center small">Enter your email & password to login</p>
    </div>

    <form class="row g-3 needs-validation" novalidate method="post" action="{{route('login')}}">
        @csrf
        <div class="col-12">
            <label for="yourEmail" class="form-label">Email</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="yourEmail" required autocomplete="true">
                @error('email')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <label for="yourPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="yourPassword" required>
            @error('password')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Login</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">Don't have account? <a href="{{route('register')}}">Create an account</a></p>
        </div>
        <div>
            @if (Route::has('password.request'))
                <a class="small mb-0" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </div>
    </form>
@endsection
