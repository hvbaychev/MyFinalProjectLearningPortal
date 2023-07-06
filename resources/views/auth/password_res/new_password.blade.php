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
                <p class="mb-2">Enter and confirm your new password</p>
          <form action="{{ route('reset_password_post') }}" method="post">
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
              <input type="hidden" name="token" value="{{ $token }}">
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="password" class="form-label">New Password</label>
                      <input type="password" name="password" class="form-control">
                      <span class="text-danger">@error('password') {{$message}} @enderror</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="confirm_password" class="form-label">Confirm Password</label>
                      <input type="password" name="confirm_password" class="form-control">
                      <span class="text-danger">@error('confirm_password') {{$message}} @enderror</span>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <button type="submit" class="btn btn-primary">
                        Reset Password
                      </button>
                  </div>
                </div>
                <span>Don't have an account? <a href="{{ route('register') }}">sign in</a></span>
              </form>
        </div>
      </div>
    </div>
  </section>
@endsection