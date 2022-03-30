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

    @isset($customer)
    <section class="section">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add suit <span> | {{$customer->fullName}}</span></h5>

                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}} <a href="{{route('customer.selection', $customer)}}">Add another measurement</a> </div>
                @endif

                <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('create.suit')}}">
                    @csrf
                    <div class="col-md-4">
                        <label for="half-back" class="form-label">Half back</label>
                        <input type="number" name="half_back" class="form-control" id="half-back" required>
                        <div class="invalid-feedback">
                            Please enter half back
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder" class="form-label">Shoulder</label>
                        <input type="number" name="shoulder" class="form-control" id="shoulder" required>
                        <div class="invalid-feedback">
                            Please enter shoulder
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="elbow" class="form-label">Elbow</label>
                            <input type="number" name="elbow" class="form-control" id="elbow" required>
                            <div class="invalid-feedback">
                                Please enter elbow
                            </div>
                    </div>
                    <div class="col-md-4">
                        <label for="sleeve" class="form-label">Sleeve</label>
                        <input type="number" name="sleeve" class="form-control" id="sleeve" required>
                        <div class="invalid-feedback">
                            Please enter sleeve
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="chest" class="form-label">Chest</label>
                        <input type="number" name="chest" class="form-control" id="chest" required>
                        <div class="invalid-feedback">
                            Please enter chest
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="suit-length" class="form-label">Suit Length</label>
                        <input type="number" name="suit_length" class="form-control" id="suit-length" required>
                        <div class="invalid-feedback">
                            Please enter suit length
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-25" type="submit">Save</button>
                    </div>
                </form><!-- End Custom Styled Validation -->

            </div>
        </div>
    </section>
    @endisset

@endsection
