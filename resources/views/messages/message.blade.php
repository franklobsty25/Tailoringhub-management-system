@extends('components.master-index')
@section('content')
    <div class="pagetitle">
        <h1>Notification</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item">Profile</li>
                <li class="breadcrumb-item active">Notification</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-body">

                <form class="row g-3" method="post" action="{{route('send.message')}}">
                    @csrf
                    <h5 class="card-title">SMS <span>| Send message to {{$customer->fullName}} to pick up design</span></h5>

                    @if (session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                        @elseif (session('error'))
                        <div class="alert alert-danger">{{session('error')}}</div>
                    @endif

                    <div class="col-md-12">
                        <input type="hidden" class="form-control" name="contact" value="0{{$customer->contact}}">
                      </div>

                    <div class="col-md-12">
                        <label for="message" class="form-label">Message</label>
                        <textarea  name="message" class="form-control @error('message') is-invalid @enderror" id="message"></textarea>
                        @error('message')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success w-25" type="submit"><i class="ri-mail-send-fill"></i> Send Message</button>
                    </div>
                </form><!-- End Customer form -->

            </div>
        </div>
    </section>
@endsection
