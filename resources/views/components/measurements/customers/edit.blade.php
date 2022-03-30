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
                <h5 class="card-title">Edit <span> | Customer</span></h5>

                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif

                <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('update.customer', $customer)}}">
                    @csrf @method('PUT')

                    <div class="col-md-4">
                        <label for="firstName" class="form-label">Firstname</label>
                        <input type="text" name="firstName" class="form-control" id="firstName" value="{{$customer->firstName}}" required>
                        <div class="invalid-feedback">
                            Please enter firstname
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="lastName" class="form-label">Lastname</label>
                        <input type="text" name="lastName" class="form-control" id="lastName" value="{{$customer->lastName}}" required>
                        <div class="invalid-feedback">
                            Please enter lastname
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="number" name="contact" class="form-control" id="contact" value="0{{$customer->contact}}" required>
                        <div class="invalid-feedback">
                            Please enter contact
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="address" class="form-label">Address/Location</label>
                        <input type="text" name="address" class="form-control" id="address" value="{{$customer->address}}" required>
                        <div class="invalid-feedback">
                            Please enter address or location
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="collection" class="form-label">Date of Collection</label>
                        <input type="date" name="collectionDate" class="form-control" id="collection" value="{{$customer->collectionDate}}" required>
                        <div class="invalid-feedback">
                            Please enter date of collection
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="charge" class="form-label">Fee charge GHS</label>
                        <input type="number" name="charge" class="form-control" id="charge" value="{{$customer->charge}}" required>
                        <div class="invalid-feedback">
                            Please enter fee charge
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="advance" class="form-label">Advance paid GHS</label>
                        <input type="number" name="advance" class="form-control" id="advance" value="{{$customer->advance}}">
                    </div>
                    <div class="col-md-4">
                        <label for="balance" class="form-label">Balance left GHS</label>
                        <input type="number" name="balance" class="form-control" id="balance" value="{{$customer->balance}}">
                    </div>
                    <div class="col-md-4">
                        <label for="style" class="form-label">Style</label>
                        <input type="text" name="style" class="form-control" id="style" value="{{$customer->style}}">
                    </div>
                    <div class="col-md-12">
                        <label for="material" class="form-label">Material type</label>
                        <input type="text" name="materialType" class="form-control" id="material" value="{{$customer->materialType}}">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-25" type="submit">Update</button>
                    </div>
                </form><!-- End Custom Styled Validation -->

            </div>
        </div>
    </section>
@endsection
