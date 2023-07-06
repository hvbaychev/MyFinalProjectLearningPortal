@extends('layouts.index')
@section('content')
    <!-- END header -->

    <section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Login</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END section -->
    <!-- END section -->


    <section class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-5 box">
            <h2 class="mb-5">Log in with your account</h2>
            <form action="{{ route('login') }}" method="post">
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
                      <label for="name">Email</label>
                      <input type="email" id="name" class="form-control" name="email">
                      <span class="text-danger">@error('email') {{$message}} @enderror</span>

                    </div>
                  </div>
                  <div class="row mb-5">
                    <div class="col-md-12 form-group">
                      <label for="name">Password</label>
                      <input type="password" id="name" class="form-control" name="password">
                      <span class="text-danger">@error('password') {{$message}} @enderror</span>

                      <a class="a_forgot_pass" href="{{ route('forgot_password') }}" >Forgot Password?</a>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input type="submit" value="Login" class="btn btn-primary">
                    </div>
                    <div class="text-right">
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    </div>
                  </div>
                </form>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    @endsection

