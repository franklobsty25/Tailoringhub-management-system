@extends('components.credential-index')

@section('content')
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
        <p class="text-center small"></p>
    </div>

    <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="col-12">
            <label for="yourEmail" class="form-label">Email</label>
            <div class="input-group has-validation">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="yourEmail" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <label for="yourPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="yourPassword" required autocomplete="new-password">
            @error('password')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="password-confirm" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password-confirm" required autocomplete="new-password">
        </div>
        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Reset Password</button>
        </div>
    </form>
@endsection

