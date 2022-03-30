@extends('components.master-index')
@section('content')
<div class="pagetitle">
    <h1>Suggestions</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">Profile</li>
        <li class="breadcrumb-item active">Suggestions</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section contact">

    <div class="row gy-4">

      <div class="col-xl-12">
        <div class="card p-4">
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif

          <form action="{{route('send.support')}}" method="post">
              @csrf
            <div class="row gy-4">

              <div class="col-md-12">
                <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" placeholder="Subject">
                @error('subject')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
              </div>

              <div class="col-md-12">
                <!-- TinyMCE Editor -->
              <textarea name="message" class="tinymce-editor @error('message') is-invalid @enderror"></textarea><!-- End TinyMCE Editor -->
              @error('message')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
              </div>

              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary"><i class="ri-mail-send-fill"></i> Send Message</button>
              </div>

            </div>
          </form>
        </div>

      </div>

    </div>

  </section>
@endsection
