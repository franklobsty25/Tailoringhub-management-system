@extends('components.credential-index')

@section('content')
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
        <p class="text-center small">Provide your email for password reset</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="col-12">
            <label for="yourEmail" class="form-label">Email</label>
            <div class="input-group has-validation">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="yourEmail" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Send Password Reset Link</button>
        </div>
    </form>
@endsection
