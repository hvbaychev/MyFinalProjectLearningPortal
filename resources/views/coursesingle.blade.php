@extends('layouts.index')
@section('content')
    <!-- END header -->

    <section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/webdesign.jpg);">
      <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
          <div class="col-md-12">

            <div class="mb-5 element-animate">
              <div class="row align-items-center">
                <div class="col-md-8">
                  <h1 class="mb-0">Web Design 101</h1>
                  <p>By Gregg White</p>
                  <p class="lead mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis, fuga.</p>

                  <p><a href="#" class="btn btn-primary mr-2">Start Series</a> <a href="#" class="btn btn-outline-white">Add To Watch List</a></p>
                </div>
                <div class="col-md-4">
                  <img src="images/webdesign.jpg" alt="Image placeholder" class="img-fluid">
                </div>
              </div>
            </div>




          </div>
        </div>
      </div>
    </section>
    <!-- END section -->


     <section class="site-section episodes">
      <div class="container">
        <div class="row bg-light align-items-center p-4 episode">
          <div class="col-md-3">
            <span class="episode-number">1</span>
          </div>
          <div class="col-md-9">
            <p class="meta">Episode 1 <a href="#">Runtime 2:53</a></p>
            <h2><a href="#">Some Title Here For The Video</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, fugit!</p>
          </div>
        </div>

        <div class="row align-items-center p-4 episode">
          <div class="col-md-3">
            <span class="episode-number">2</span>
          </div>
          <div class="col-md-9">
            <p class="meta">Episode 2 <a href="#">Runtime 5:12</a></p>
            <h2><a href="#">Some Title Here For The Video</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, fugit!</p>
          </div>
        </div>

        <div class="row bg-light align-items-center p-4 episode">
          <div class="col-md-3">
            <span class="episode-number">3</span>
          </div>
          <div class="col-md-9">
            <p class="meta">Episode 3 <a href="#">Runtime 5:12</a></p>
            <h2><a href="#">Some Title Here For The Video</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, fugit!</p>
          </div>
        </div>

        <div class="row align-items-center p-4 episode">
          <div class="col-md-3">
            <span class="episode-number">4</span>
          </div>
          <div class="col-md-9">
            <p class="meta">Episode 4 <a href="#">Runtime 6:55</a></p>
            <h2><a href="#">Some Title Here For The Video</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, fugit!</p>
          </div>
        </div>

        <div class="row bg-light align-items-center p-4 episode">
          <div class="col-md-3">
            <span class="episode-number">5</span>
          </div>
          <div class="col-md-9">
            <p class="meta">Episode 5 <a href="#">Runtime 14:33</a></p>
            <h2><a href="#">Some Title Here For The Video</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, fugit!</p>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <h2>You May Also Like</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum magnam illum maiores adipisci pariatur, eveniet.</p>
          </div>
        </div>


        <div class="row top-course">
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="#" class="course">
              <img src="images/webdesign.jpg" alt="Image placeholder">
              <h2>Web Design 101</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="#" class="course">
              <img src="images/wordpress.jpg" alt="Image placeholder">
              <h2>Learn How To Develop WordPress Plugin</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="#" class="course">
              <img src="images/javascript.jpg" alt="Image placeholder">
              <h2>JavaScript 101</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="#" class="course">
              <img src="images/photoshop.jpg" alt="Image placeholder">
              <h2>Photoshop Design 101</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="#" class="course">
              <img src="images/reactjs.jpg" alt="Image placeholder">
              <h2>Learn Native ReactJS</h2>
              <p>Enroll Now</p>
            </a>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6 col-12">
            <a href="#" class="course">
              <img src="images/angularjs.jpg" alt="Image placeholder">
              <h2>Learn AngularJS 2</h2>
              <p>Enroll Now</p>
            </a>
          </div>
        </div>
        <!-- END row -->


      </div>
    </section>
    <!-- END section -->



    <section class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center">
            <h2>Meet Your Instructors</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum magnam illum maiores adipisci pariatur, eveniet.</p>
          </div>
        </div>
        <section class="school-features text-dark d-flex">

          <div class="inner">
            <div class="media d-block feature text-center">
              <img src="images/person_1.jpg" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Rhea Smith</h3>
                <p class="instructor-meta">WordPress Expert</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora fuga suscipit numquam esse saepe quam, eveniet iure assumenda dignissimos aliquam!</p>
              </div>
            </div>

            <div class="media d-block feature text-center">
              <img src="images/person_2.jpg" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Gregg White</h3>
                <p class="instructor-meta">HTML4, CSS3 Expert</p>
                <p>Delectus fuga voluptatum minus amet, mollitia distinctio assumenda voluptate quas repellat eius quisquam odio. Aliquam, laudantium, optio? Error velit, alias.</p>
              </div>
            </div>

            <div class="media d-block feature text-center">
              <img src="images/person_3.jpg" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Rob Gold</h3>
                <p class="instructor-meta">JS Expert</p>
                <p>Delectus fuga voluptatum minus amet, mollitia distinctio assumenda voluptate quas repellat eius quisquam odio. Aliquam, laudantium, optio? Error velit, alias.</p>
              </div>
            </div>


            <div class="media d-block feature text-center">
              <img src="images/person_4.jpg" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Wennie Poe</h3>
                <p class="instructor-meta">Angular JS Expert</p>
                <p>Harum, adipisci, aspernatur. Vero repudiandae quos ab debitis, fugiat culpa obcaecati, voluptatibus ad distinctio cum soluta fugit sed animi eaque?</p>
              </div>
            </div>
          </div>
        </section>

        <section class="school-features text-dark last d-flex">

          <div class="inner">
            <div class="media d-block feature text-center">
              <img src="images/person_1.jpg" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Rhea Smith</h3>
                <p class="instructor-meta">WordPress Expert</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora fuga suscipit numquam esse saepe quam, eveniet iure assumenda dignissimos aliquam!</p>
              </div>
            </div>

            <div class="media d-block feature text-center">
              <img src="images/person_2.jpg" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Gregg White</h3>
                <p class="instructor-meta">Photoshop Expert</p>
                <p>Delectus fuga voluptatum minus amet, mollitia distinctio assumenda voluptate quas repellat eius quisquam odio. Aliquam, laudantium, optio? Error velit, alias.</p>
              </div>
            </div>

            <div class="media d-block feature text-center">
              <img src="images/person_3.jpg" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Rob Gold</h3>
                <p class="instructor-meta">Web Design Expert</p>
                <p>Delectus fuga voluptatum minus amet, mollitia distinctio assumenda voluptate quas repellat eius quisquam odio. Aliquam, laudantium, optio? Error velit, alias.</p>
              </div>
            </div>


            <div class="media d-block feature text-center">
              <img src="images/person_4.jpg" alt="Image placeholder" class="mb-3">
              <div class="media-body">
                <h3 class="mt-0">Wennie Poe</h3>
                <p class="instructor-meta">React JS Expert</p>
                <p>Harum, adipisci, aspernatur. Vero repudiandae quos ab debitis, fugiat culpa obcaecati, voluptatibus ad distinctio cum soluta fugit sed animi eaque?</p>
              </div>
            </div>
          </div>
        </section>


      </div>
    </section>
    <!-- END section -->

    <section class="section-cover bg-dark">
      <div class="container">
        <div class="row justify-content-center align-items-center intro">
          <div class="col-md-7 text-center element-animate">
            <h2>Sign Up And Get a 7-day Free Trial</h2>
            <p class="lead mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto quidem tempore expedita facere facilis, dolores!</p>
            <p><a href="#" class="btn btn-primary">Sign up and get a 7-day free trial</a></p>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    @endsection


