@extends('components.credential-index')
@section('content')
    <div class="card-body">

        <div class="pt-4 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
            <p class="text-center small">Enter your personal details to create account</p>
        </div>

        <form class="row g-3 needs-validation" novalidate method="post" action="{{route('register')}}">
            @csrf
            <div class="col-12">
                <label for="yourfirstName" class="form-label">First Name</label>
                <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror" id="yourfirstName">
                @error('firstName')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="yourlastName" class="form-label">Last Name</label>
                <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" id="yourlastName">
                @error('lastName')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="col-12">
                <label for="yourEmail" class="form-label">Email</label>
                <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="yourEmail">
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
                <label for="confirmedPassword" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control @error('confirmed_password') is-invalid @enderror" id="confirmedPassword" autocomplete="new-password">
                @error('confirmed_password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                @if(session('err'))
                    <div class="alet alert-danger">{{session('err')}}</div>
                @endif
            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100" type="submit">Create Account</button>
            </div>
            <div class="col-12">
                <p class="small mb-0">Already have an account? <a href="{{route('login')}}">Log in</a></p>
            </div>
        </form>
@endsection
