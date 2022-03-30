@extends('components.master-index')

@section('content')
    <div class="pagetitle">
        <h1>Measurement</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item">Profile</li>
                <li class="breadcrumb-item active">Measurement</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">

                <form class="row g-3" method="POST" action="{{route('customer.create')}}">
                    @csrf
                    <h5 class="card-title">Add <span>| Customer</span></h5>

                    @if (session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    <div class="col-md-4">
                        <label for="firstName" class="form-label">Firstname</label>
                        <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror" id="firstName">
                        @error('firstName')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="lastName" class="form-label">Lastname</label>
                        <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" id="lastName">
                        @error('lastName')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="number" name="contact" maxlength="10" class="form-control @error('contact') is-invalid @enderror" id="contact">
                        @error('contact')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="address" class="form-label">Address/Location</label>
                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address">
                        @error('address')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="collection" class="form-label">Date of Collection</label>
                        <input type="date" name="collectionDate" class="form-control @error('collectionDate') is-invalid @enderror" id="collection">
                        @error('collectionDate')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="charge" class="form-label">Fee charge GHS</label>
                        <input type="number" name="charge" class="form-control @error('charge') is-invalid @enderror" id="charge">
                        @error('charge')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="advance" class="form-label">Advance paid GHS</label>
                        <input type="number" name="advance" class="form-control" id="advance">
                    </div>
                    <div class="col-md-4">
                        <label for="balance" class="form-label">Balance left GHS</label>
                        <input type="number" name="balance" class="form-control @error('balance') is-invalid @enderror" id="balance">
                        @error('balance')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="style" class="form-label">Style</label>
                        <input type="text" name="style" class="form-control" id="style">
                    </div>
                    <div class="col-md-12">
                        <label for="material" class="form-label">Material type</label>
                        <input type="text" name="materialType" class="form-control" id="material">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-25" type="submit">Save &amp; continue</button>
                    </div>
                </form><!-- End Customer form -->

            </div>
        </div>
    </section>
@endsection
