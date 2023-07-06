@extends('layouts.index')
@section('content')

<section class="" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}'); height: 100px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
            <div class="col-md-8 text-center">

                <div class="mb-5 element-animate">

                </div>

            </div>
        </div>
    </div>
</section>

  <section class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 box">
          <h2 class="mb-5">Forgot Password?</h2>
                <p class="mb-2">Enter your registered email so we can send you a message</p>
          <form action="{{ route('forgot_password_post') }}" method="post">
            @method('POST')
                  @if(Session::has('success'))
                      <div class="alert alert-success">{{Session::get('success')}}</div>
                  @endif
                  @if(Session::has('fail'))
                      <div class="alert alert-danger">{{Session::get('fail')}}</div>
                  @endif
              @csrf
                <div class="row">
                  <div class="col-md-12 form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" name="email" placeholder="Enter Your Email"
                    required="">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <div class="d-flex justify-content-between align-items-center">
                      <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Reset Password</button>
                          <a href="{{ route('show_form') }}" class="btn btn-primary">Back</a>
                    </div>
                  </div>
                </div>
                <span>Don't have an account? <a href="{{ route('register') }}">sign in</a></span>
              </form>
        </div>
      </div>
    </div>
  </section>
@endsection