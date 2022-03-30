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
                <h5 class="card-title">Edit blouse/dress/skirt <span> | {{$customer->fullName}}</span></h5>

                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif

                <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('update.blouse.dress.skirt')}}">
                    @csrf @method('PUT')
                    <div class="col-md-4">
                        <label for="bust" class="form-label">Bust</label>
                        <input type="number" name="bust" class="form-control" id="bust" value="{{$blouseDressSkirt->bust}}" required>
                        <div class="invalid-feedback">
                            Please enter bust
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="waist" class="form-label">Waist</label>
                        <input type="number" name="waist" class="form-control" id="waist" value="{{$blouseDressSkirt->waist}}" required>
                        <div class="invalid-feedback">
                            Please enter waist
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="hip" class="form-label">Hip</label>
                        <input type="number" name="hip" class="form-control" id="hip" value="{{$blouseDressSkirt->hip}}" required>
                        <div class="invalid-feedback">
                            Please enter hip
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder" class="form-label">Shoulder</label>
                        <input type="number" name="shoulder" class="form-control" id="shoulder" value="{{$blouseDressSkirt->shoulder}}" required>
                        <div class="invalid-feedback">
                            Please enter shoulder
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder-nipple" class="form-label">Shoulder to nipple</label>
                        <input type="number" name="shoulder_nipple" class="form-control" id="shoulder-nipple" value="{{$blouseDressSkirt->shoulder_nipple}}" required>
                        <div class="invalid-feedback">
                            Please enter shoulder to nipple
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="nipple-nipple" class="form-label">Nipple to nipple</label>
                        <input type="number" name="nipple_nipple" class="form-control" id="nipple-nipple" value="{{$blouseDressSkirt->nipple_nipple}}" required>
                        <div class="invalid-feedback">
                            Please enter nipple to nipple
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="nape-waist" class="form-label">Nape to waist</label>
                        <input type="number" name="nape_waist" class="form-control" id="nape-waist" value="{{$blouseDressSkirt->nape_waist}}" required>
                        <div class="invalid-feedback">
                            Please enter nape to waist
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder-waist" class="form-label">Shoulder to waist</label>
                        <input type="number" name="shoulder_waist" class="form-control" id="shoulder-waist" value="{{$blouseDressSkirt->shoulder_waist}}" required>
                        <div class="invalid-feedback">
                            Please enter shoulder to waist
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder-hip" class="form-label">Shoulder to hip</label>
                        <input type="number" name="shoulder_hip" class="form-control" id="shoulder-hip" value="{{$blouseDressSkirt->shoulder_hip}}" required>
                        <div class="invalid-feedback">
                            Please enter shoulder to hip
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="across-chest" class="form-label">Across chest</label>
                        <input type="number" name="across_chest" class="form-control" id="across-chest" value="{{$blouseDressSkirt->across_chest}}" required>
                        <div class="invalid-feedback">
                            Please enter across chest
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="dress-length" class="form-label">dress length</label>
                        <input type="number" name="dress_length" class="form-control" id="dress-length" value="{{$blouseDressSkirt->dress_length}}" required>
                        <div class="invalid-feedback">
                            Please enter dress length
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="sleeve-length" class="form-label">Sleeve length</label>
                        <input type="number" name="sleeve_length" class="form-control" id="sleeve-length" value="{{$blouseDressSkirt->sleeve_length}}" required>
                        <div class="invalid-feedback">
                            Please enter sleeve length
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="around-arm" class="form-label">Around arm</label>
                        <input type="number" name="around_arm" class="form-control" id="around-arm" value="{{$blouseDressSkirt->around_arm}}" required>
                        <div class="invalid-feedback">
                            Please enter around arm
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="across-back" class="form-label">Across back</label>
                        <input type="number" name="across_back" class="form-control" id="across-back" value="{{$blouseDressSkirt->across_back}}" required>
                        <div class="invalid-feedback">
                            Please enter across back
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="skirt-length" class="form-label">Skirt length</label>
                        <input type="number" name="skirt_length" class="form-control" id="skirt-length" value="{{$blouseDressSkirt->skirt_length}}" required>
                        <div class="invalid-feedback">
                            Please enter skirt length
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
