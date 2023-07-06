@extends('layouts.index')

@section('content')
   <section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
        <div class="container">
            <div class="row align-items-center site-hero-inner2 justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="mb-5 element-animate">
                        <h1>Contact Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
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
