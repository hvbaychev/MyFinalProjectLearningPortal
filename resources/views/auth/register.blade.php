@extends('layouts.index')
@section('content')
    <!-- END header -->

    <section class="site-hero site-hero-innerpage overlay" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
      <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
          <div class="col-md-8 text-center">

            <div class="mb-5 element-animate">
              <h1>Register</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->


    <section class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 box">
                <h2 class="mb-5">Register new account</h2>
                <form action="{{ route('registerUser') }}" method="post">
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
                            <label for="name">First Name</label>
                            <input type="text" id="name" class="form-control" name="first_name" value="{{ old('first_name') }}">
                            <span class="text-danger">@error('first_name') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="name">Last Name</label>
                            <input type="text" id="name" class="form-control" name="last_name" value="{{ old('last_name') }}">
                            <span class="text-danger">@error('last_name') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="email">Email Address</label>
                            <input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}">
                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password">
                            <span class="text-danger">@error('password') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12 form-group">
                            <label for="password_confirmation">Re-type Password</label>
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation">
                            <span class="text-danger">@error('password_confirmation') {{$message}} @enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="submit" value="Register" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

    <!-- END section -->

     <section class="overflow">
      <div class="container">
        <div class="row justify-content-center align-items-center">


          <div class="col-lg-7 order-lg-3 order-1 mb-lg-0 mb-5">
            <img src="images/person_testimonial_1.jpg" alt="Image placeholder" class="img-md-fluid">
          </div>
          <div class="col-lg-1 order-lg-2"></div>
          <div class="col-lg-4 order-lg-1 order-2 mb-lg-0 mb-5">
            <blockquote class="testimonial">
              &ldquo; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt incidunt nihil ab cumque molestiae commodi. &rdquo;
            </blockquote>
            <p>&mdash; John Doe, Certified ReactJS Student</p>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->
    @endsection

