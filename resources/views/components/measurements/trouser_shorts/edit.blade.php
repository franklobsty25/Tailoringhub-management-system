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
                <h5 class="card-title">Edit shorts/trouser <span> | {{$customer->fullName}}</span></h5>

                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif

                <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('update.short.trouser')}}">
                    @csrf @method('PUT')
                    <div class="col-md-4">
                        <label for="waist" class="form-label">Waist</label>
                        <input type="number" name="waist" class="form-control" id="waist" value="{{$shortTrouser->waist}}" required>
                        <div class="invalid-feedback">
                            Please enter waist
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="length" class="form-label">Length</label>
                        <input type="number" name="length" class="form-control" id="length" value="{{$shortTrouser->length}}" required>
                        <div class="invalid-feedback">
                            Please enter length
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="thighs" class="form-label">Thighs</label>
                        <input type="number" name="thighs" class="form-control" id="thighs" value="{{$shortTrouser->thighs}}" required>
                        <div class="invalid-feedback">
                            Please enter thighs
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="bass" class="form-label">Bass/Bottom</label>
                        <input type="number" name="bass_bottom" class="form-control" id="bass" value="{{$shortTrouser->bass_bottom}}" required>
                        <div class="invalid-feedback">
                            Please enter bass/bottom
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="seat" class="form-label">Seat</label>
                        <input type="number" name="seat" class="form-control" id="seat" value="{{$shortTrouser->seat}}" required>
                        <div class="invalid-feedback">
                            Please enter seat
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="knee" class="form-label">Knee</label>
                        <input type="number" name="knee" class="form-control" id="knee" value="{{$shortTrouser->knee}}" required>
                        <div class="invalid-feedback">
                            Please enter knee
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="flap" class="form-label">Flap/Fly</label>
                        <input type="number" name="flap_fly" class="form-control" id="flap" value="{{$shortTrouser->flap_fly}}" required>
                        <div class="invalid-feedback">
                            Please enter flap/fly
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="hip" class="form-label">Hip</label>
                        <input type="number" name="hip" class="form-control" id="hip" value="{{$shortTrouser->hip}}" required>
                        <div class="invalid-feedback">
                            Please enter hip
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="waist-knee" class="form-label">Waist Knee</label>
                        <input type="number" name="waist_knee" class="form-control" id="waist-knee" value="{{$shortTrouser->waist_knee}}" required>
                        <div class="invalid-feedback">
                            Please enter waist knee
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-25" type="submit">Update</button>
                    </div>
                </form><!-- End Custom Styled Validation -->

            </div>
        </div>
    </section>

@endsection
