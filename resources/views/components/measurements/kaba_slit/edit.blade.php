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
                <h5 class="card-title">Edit kaba & slit <span> | {{$customer->fullName}}</span> </h5>

                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif

                <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('update.kaba.slit')}}">
                    @csrf @method('PUT')
                    <div class="col-md-4">
                        <label for="bust" class="form-label">Bust</label>
                        <input type="number" name="bust" class="form-control" id="bust" value="{{$kabaSlit->bust}}" required>
                        <div class="invalid-feedback">
                            Please enter bust
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="waist" class="form-label">Waist</label>
                        <input type="number" name="waist" class="form-control" id="waist" value="{{$kabaSlit->waist}}" required>
                        <div class="invalid-feedback">
                            Please enter waist
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="hip" class="form-label">Hip</label>
                        <input type="number" name="hip" class="form-control" id="hip" value="{{$kabaSlit->hip}}" required>
                        <div class="invalid-feedback">
                            Please enter hip
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder" class="form-label">Shoulder</label>
                        <input type="number" name="shoulder" class="form-control" id="shoulder" value="{{$kabaSlit->shoulder}}" required>
                        <div class="invalid-feedback">
                            Please enter shoulder
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder-nipple" class="form-label">Shoulder to nipple</label>
                        <input type="number" name="shoulder_nipple" class="form-control" id="shoulder-nipple" value="{{$kabaSlit->shoulder_nipple}}" required>
                        <div class="invalid-feedback">
                            Please enter shoulder to nipple
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="nipple-nipple" class="form-label">Nipple to nipple</label>
                        <input type="number" name="nipple_nipple" class="form-control" id="nipple-nipple" value="{{$kabaSlit->nipple_nipple}}" required>
                        <div class="invalid-feedback">
                            Please enter nipple to nipple
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="nape-waist" class="form-label">Nape to waist</label>
                        <input type="number" name="nape_waist" class="form-control" id="nape-waist" value="{{$kabaSlit->nape_waist}}" required>
                        <div class="invalid-feedback">
                            Please enter nape to waist
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder-waist" class="form-label">Shoulder to waist</label>
                        <input type="number" name="shoulder_waist" class="form-control" id="shoulder-waist" value="{{$kabaSlit->shoulder_waist}}" required>
                        <div class="invalid-feedback">
                            Please enter shoulder to waist
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder-hip" class="form-label">Shoulder to hip</label>
                        <input type="number" name="shoulder_hip" class="form-control" id="shoulder-hip" value="{{$kabaSlit->shoulder_hip}}" required>
                        <div class="invalid-feedback">
                            Please enter shoulder to hip
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="across-chest" class="form-label">Across chest</label>
                        <input type="number" name="across_chest" class="form-control" id="across-chest" value="{{$kabaSlit->across_chest}}" required>
                        <div class="invalid-feedback">
                            Please enter across chest
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="kaba-length" class="form-label">Kaba length</label>
                        <input type="number" name="kaba_length" class="form-control" id="kaba-length" value="{{$kabaSlit->kaba_length}}" required>
                        <div class="invalid-feedback">
                            Please enter kaba length
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="sleeve-length" class="form-label">Sleeve length</label>
                        <input type="number" name="sleeve_length" class="form-control" id="sleeve-length" value="{{$kabaSlit->sleeve_length}}" required>
                        <div class="invalid-feedback">
                            Please enter sleeve length
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="around-arm" class="form-label">Around arm</label>
                        <input type="number" name="around_arm" class="form-control" id="around-arm" value="{{$kabaSlit->around_arm}}" required>
                        <div class="invalid-feedback">
                            Please enter around arm
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="across-back" class="form-label">Across back</label>
                        <input type="number" name="across_back" class="form-control" id="across-back" value="{{$kabaSlit->across_back}}" required>
                        <div class="invalid-feedback">
                            Please enter across back
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="slit-lenth" class="form-label">Slit length</label>
                        <input type="number" name="slit_length" class="form-control" id="slit-length" value="{{$kabaSlit->slit_length}}" required>
                        <div class="invalid-feedback">
                            Please enter slit length
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
