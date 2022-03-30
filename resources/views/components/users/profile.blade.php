<x-master-index>
    @section('content')
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{Auth::user()->detail->image ?? asset('assets/img/logo.png')}}" alt="{{Auth::user()->fullName ?? 'logo'}}" class="rounded-circle">
                            <h2>{{Auth::user()->fullName ?? ''}}</h2>
                            <h3>{{Auth::user()->job ?? ''}}</h3>
                            <div class="social-links mt-2">
                                <a href="{{Auth::user()->detail->twitter ?? 'https://twitter.com/FRANKLOBSTY'}}" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="{{Auth::user()->detail->facebook ?? 'https://web.facebook.com/colonkoded'}}" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="{{Auth::user()->detail->instagram ?? 'https://www.instagram.com/colonkoded/?hl=en'}}" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="{{Auth::user()->detail->linkedIn ?? 'https://www.linkedin.com/company/72459776/admin/'}}" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    @if(Auth::user()->detail && Auth::user()->detail->about != null)
                                    <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">{{Auth::user()->detail->about ?? ''}}</p>
                                    @endif
                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">{{Auth::user()->fullName ?? ''}}</div>
                                    </div>

                                    @if(Auth::user()->detail && Auth::user()->detail->company != null)
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Company</div>
                                        <div class="col-lg-9 col-md-8">{{Auth::user()->detail->company ?? ''}}</div>
                                    </div>
                                    @endif

                                    @if(Auth::user()->detail && Auth::user()->detail->job != null)
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Job</div>
                                        <div class="col-lg-9 col-md-8">{{Auth::user()->detail->job ?? ''}}</div>
                                    </div>
                                    @endif

                                    @if(Auth::user()->detail && Auth::user()->detail->country != null)
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Country</div>
                                        <div class="col-lg-9 col-md-8">{{Auth::user()->detail->country ?? ''}}</div>
                                    </div>
                                    @endif

                                    @if(Auth::user()->detail && Auth::user()->detail->address != null)
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">{{Auth::user()->detail->address ?? ''}}</div>
                                    </div>
                                    @endif

                                    @if(Auth::user()->detail && Auth::user()->detail->phone != null)
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">0{{Auth::user()->detail->phone ?? ''}}</div>
                                    </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{Auth::user()->email ?? ''}}</div>
                                    </div>

                                    @if (Auth::user()->subscription_ref != null)
                                    <div class="row">
                                        <small>
                                            <form method="post" action="{{route('cancel.subscription')}}">@csrf<button type="submit" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#verticalycentered">Cancel Subscription</button></form>
                                        </small>
                                    </div>
                                    @endif

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    @if(session('update-message'))
                                        <div class="alert alert-success">{{session('update-message')}}</div>
                                    @endif

                                    <!-- Profile Edit Form -->
                                    <form method="post" action="{{route('profile.create')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="pt-2">
                                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" title="Upload new profile image" value="{{Auth::user()->detail->image ?? ''}}">
                                                    @error('image')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fullName" type="text" class="form-control" id="fullName" value="{{Auth::user()->fullName}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea name="about" class="form-control" id="about" style="height: 100px">{{Auth::user()->detail->about ?? ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="company" type="text" class="form-control" id="company" value="{{Auth::user()->detail->company ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="job" type="text" class="form-control" id="Job" value="{{Auth::user()->detail->job ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="country" type="text" class="form-control" id="Country" value="{{Auth::user()->detail->country ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="Address" value="{{Auth::user()->detail->address ?? ''}}">
                                            </div>
                                        </div>

                                        @if(Auth::user()->detail && Auth::user()->detail->phone != null)
                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="number" maxlength="10" class="form-control" id="Phone" value="0{{Auth::user()->detail->phone ?? ''}}">
                                            </div>
                                        </div>
                                        @else
                                            <div class="row mb-3">
                                                <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="phone" type="number" maxlength="10" class="form-control" id="Phone" value="{{Auth::user()->detail->phone ?? ''}}">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email" value="{{Auth::user()->email ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Link</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="twitter" type="text" class="form-control" id="Twitter" value="{{Auth::user()->detail->twitter ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Link</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="facebook" type="text" class="form-control" id="Facebook" value="{{Auth::user()->detail->facebook ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Link</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="instagram" type="text" class="form-control" id="Instagram" value="{{Auth::user()->detail->instagram ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Link</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="linkedIn" type="text" class="form-control" id="Linkedin" value="{{Auth::user()->detail->linkedIn ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    @if(session('mismatch'))
                                        <div class="alert alert-danger">{{session('mismatch')}}</div>
                                        @elseif(session('update-password'))
                                        <div class="alert alert-success">{{session('update-password')}}</div>
                                    @endif
                                    <!-- Change Password Form -->
                                    <form method="post" action="{{route('profile.update')}}">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" id="currentPassword">
                                                @error('current_password')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPassword">
                                                @error('new_password')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="new_password_confirmation" type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="renewPassword">
                                                @error('new_password_confirmation')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                    <div class="modal fade" id="verticalycentered" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cancellation submitted</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success">
                                <p>Your request to cancel your subscription has been received. It will take <strong>48 hours</strong> to process your request. Thank you.</p>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div><!-- End Cancellation Modal-->

                </div>
            </div>
        </section>
    @endsection
</x-master-index>
