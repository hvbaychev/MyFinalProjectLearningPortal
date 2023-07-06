@extends('layouts.index')
@section('content')

<section class="" data-stellar-background-ratio="0.5" style="background-image: url(images/forgot_password/reset_background.jpg); height: 100px;">
  <section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/forgot_password/reset_background.jpg') }}');padding-top: 65px;">
    <div class="container">
      <div class="row align-items-center site-hero-inner2 justify-content-center">
        <div class="col-md-8 text-center">
          <div class="mb-5 element-animate">
            <h1>Update Email</h1>
          </div>
        </div>
      </div>
    </div>
</section>

  <section class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-5 box">
                  <p class="mb-2">Enter your new email address</p>
            <form action="{{ route('user_update_email_post') }}" method="post">
              @method('POST')
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              @if(Session::has('success'))
                          <div class="alert alert-success">{{Session::get('success')}}</div>
                      @endif
                      @if(Session::has('fail'))
                          <div class="alert alert-danger">{{Session::get('fail')}}</div>
                      @endif
                @csrf
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="email" class="form-label">New Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Enter Your New Email">
                      <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <button type="submit" class="btn btn-primary">
                          Update Email
                        </button>
                    </div>
                    <div>
                      <a href="{{ route('user.profile.show', ['user' => auth()->user()]) }}" class="btn btn-primary">Back To Your Profile</a>
                    </div>
                  </div>
                </form>
          </div>
        </div>
      </div>
  </section>
@endsection