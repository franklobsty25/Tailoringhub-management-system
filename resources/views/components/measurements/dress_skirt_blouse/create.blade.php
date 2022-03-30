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
                <h5 class="card-title">Add blouse/dress/skirt <span> | {{$customer->fullName}}</span></h5>

                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}} <a href="{{route('customer.selection', $customer)}}">Add another measurement</a> </div>
                @endif

                <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('create.blouse.dress.skirt')}}">
                    @csrf
                    <div class="col-md-4">
                        <label for="bust" class="form-label">Bust</label>
                        <input type="number" name="bust" class="form-control" id="bust">
                    </div>
                    <div class="col-md-4">
                        <label for="waist" class="form-label">Waist</label>
                        <input type="number" name="waist" class="form-control" id="waist">
                    </div>
                    <div class="col-md-4">
                        <label for="hip" class="form-label">Hip</label>
                        <input type="number" name="hip" class="form-control" id="hip">
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder" class="form-label">Shoulder</label>
                        <input type="number" name="shoulder" class="form-control" id="shoulder">
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder-nipple" class="form-label">Shoulder to nipple</label>
                        <input type="number" name="shoulder_nipple" class="form-control" id="shoulder-nipple">
                    </div>
                    <div class="col-md-4">
                        <label for="nipple-nipple" class="form-label">Nipple to nipple</label>
                        <input type="number" name="nipple_nipple" class="form-control" id="nipple-nipple">
                    </div>
                    <div class="col-md-4">
                        <label for="nape-waist" class="form-label">Nape to waist</label>
                        <input type="number" name="nape_waist" class="form-control" id="nape-waist">
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder-waist" class="form-label">Shoulder to waist</label>
                        <input type="number" name="shoulder_waist" class="form-control" id="shoulder-waist">
                    </div>
                    <div class="col-md-4">
                        <label for="shoulder-hip" class="form-label">Shoulder to hip</label>
                        <input type="number" name="shoulder_hip" class="form-control" id="shoulder-hip">
                    </div>
                    <div class="col-md-4">
                        <label for="across-chest" class="form-label">Across chest</label>
                        <input type="number" name="across_chest" class="form-control" id="across-chest">
                    </div>
                    <div class="col-md-4">
                        <label for="dress-length" class="form-label">dress length</label>
                        <input type="number" name="dress_length" class="form-control" id="dress-length">
                    </div>
                    <div class="col-md-4">
                        <label for="sleeve-length" class="form-label">Sleeve length</label>
                        <input type="number" name="sleeve_length" class="form-control" id="sleeve-length">
                    </div>
                    <div class="col-md-4">
                        <label for="around-arm" class="form-label">Around arm</label>
                        <input type="number" name="around_arm" class="form-control" id="around-arm">
                    </div>
                    <div class="col-md-4">
                        <label for="across-back" class="form-label">Across back</label>
                        <input type="number" name="across_back" class="form-control" id="across-back">
                    </div>
                    <div class="col-md-4">
                        <label for="skirt-length" class="form-label">Skirt length</label>
                        <input type="number" name="skirt_length" class="form-control" id="skirt-length">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-25" type="submit">Save</button>
                    </div>
                </form><!-- End Custom Styled Validation -->

            </div>
        </div>
    </section>

@endsection
