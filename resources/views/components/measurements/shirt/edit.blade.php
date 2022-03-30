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
                <h5 class="card-title">Edit shirt <span> | {{$customer->fullName}}</span> </h5>

                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif

                <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('update.shirt')}}">
                    @csrf @method('PUT')
                    <div class="col-md-4">
                        <label for="length" class="form-label">Length</label>
                        <input type="number" name="length" class="form-control" id="length" value="{{$shirt->length}}" required>
                        <div class="invalid-feedback">
                            Please enter length
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="chest" class="form-label">Chest</label>
                        <input type="number" name="chest" class="form-control" id="chest" value="{{$shirt->chest}}" required>
                        <div class="invalid-feedback">
                            Please enter chest
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="back" class="form-label">back</label>
                        <input type="number" name="back" class="form-control" id="back" value="{{$shirt->back}}" required>
                        <div class="invalid-feedback">
                            Please enter back
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="sleeve" class="form-label">Sleeve</label>
                        <input type="number" name="sleeve" class="form-control" id="sleeve" value="{{$shirt->sleeve}}" required>
                        <div class="invalid-feedback">
                            Please enter sleeve
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="around-arm" class="form-label">Around arm</label>
                        <input type="number" name="around_arm" class="form-control" id="around-arm" value="{{$shirt->around_arm}}" required>
                        <div class="invalid-feedback">
                            Please enter around arm
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="cuff" class="form-label">Cuff</label>
                        <input type="number" name="cuff" class="form-control" id="cuff" value="{{$shirt->cuff}}" required>
                        <div class="invalid-feedback">
                            Please enter cuff
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="collar" class="form-label">Collar/Neck</label>
                        <input type="number" name="collar" class="form-control" id="collar" value="{{$shirt->collar}}" required>
                        <div class="invalid-feedback">
                            Please enter collar
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="across-chest" class="form-label">Across chest</label>
                        <input type="number" name="across_chest" class="form-control" id="across-chest" value="{{$shirt->across_chest}}" required>
                        <div class="invalid-feedback">
                            Please enter across chest
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
