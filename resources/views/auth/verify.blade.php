@extends('components.credential-index')

@section('content')
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Verification</h5>
        <p class="text-center small">Verify your email address</p>
    </div>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
    <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('verification.resend') }}">
        @csrf

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Click here to request another</button>
        </div>
    </form>
@endsection
