@extends('components.credential-index')

@section('content')
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Confirm Password</h5>
        <p class="text-center small">Please confirm your password before continuing</p>
    </div>

    <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <div class="input-group has-validation">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Confirm Password</button>
        </div>
        <span class="text-left">
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </span>
    </form>
@endsection
