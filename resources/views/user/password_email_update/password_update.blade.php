@extends('layouts.index')
@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/forgot_password/reset_background.jpg') }}');padding-top: 65px;">
  <div class="container">
    <div class="row align-items-center site-hero-inner2 justify-content-center">
      <div class="col-md-8 text-center">
        <div class="mb-5 element-animate">
          <h1>Update Password</h1>
        </div>
      </div>
    </div>
  </div>
</section>

  <section class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 box">
                <p class="mb-2">Enter your new password</p>
              <form action="{{ route('user_update_password_post') }}" method="post">
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
                      <label for="password" class="form-label">New Password</label>
                      <input type="password" name="password" class="form-control">
                      <span class="text-danger">@error('password') {{$message}} @enderror</span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="password_confirm" class="form-label">Confirm New Password</label>
                      <input type="password" name="password_confirm" class="form-control">
                      <span class="text-danger">@error('password_confirm') {{$message}} @enderror</span>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <button type="submit" class="btn btn-primary">
                        Update Password
                      </button>
                  </div>
                  <div>
                    <a href="{{ route('user.profile.show', ['user' => auth()->user()]) }}" class="btn btn-primary">Go Back</a>
                  </div>
                </div>
              </form>
        </div>
      </div>
    </div>
  </section>
@endsection