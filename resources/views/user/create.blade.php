@extends('layouts.index')

@section('content')


<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Create new user</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END section -->

<section class="site-section bg-light overlay align-items-center text-center" style="background-size: 100% 100%;background-image: url({{ url('images/5541508_10972.jpg') }});">
    <div class="container text-center" style="width: 650px;">
    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif

    @if(isset($success))
        <div class="alert alert-success">{{ $success }}</div>
    @endif
    @if(isset($fail))
        <div class="alert alert-danger">{{ $fail }}</div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    <div class="container-profile">

        <div class="profile-row">
            <div class="profile-div-min profile-div-colunm-left">
                <form action="{{ route('user.store')}}" method="post" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    

                <img src="{{ url('images/doc-no.png') }}" alt="CV" class="cv" onclick="document.getElementById('cv_browse').click();">
                    <br/>
                    @if ($cv)
                        <a href="{{ $cv }}" target="_blank">View Temporary CV</a>
                    @endif
                    <input type="file" name="user_cv" id="cv_browse" accept=".pdf,.doc,.docx,.txt" style="display: none;">

                <script>
                    document.getElementById('cv_browse').addEventListener('change', function() {
                        var file = this.files[0];
                        if (file) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                document.querySelector('.cv').src = "{{ url('images/doc-ok.png') }}";
                                document.getElementById('userForm').submit();
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                </script>

            </div>
        
            <div class="profile-div-max profile-div-colunm-right">

                <label class="profile-lable" for="avatar">Add User Avatar</label>
            <img src="{{ url(config('app.files_path').'avatar/default_profile.png') }}" alt="Avatar" class="avatar" onclick="document.getElementById('avatar_browse').click();">
            <input type="file" name="avatar" id="avatar_browse" accept="image/*" style="display: none;">
            <script>
                document.getElementById('avatar_browse').addEventListener('change', function() {
                    var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.querySelector('.avatar').src = e.target.result;
                            document.getElementById('userForm').submit();
                        };
                        reader.readAsDataURL(file);
                    }
                });
            </script>
            </div>
        </div>

            <div class="profile-row">
                <div class="profile-div-colunm-left">
                    <label class="profile-lable" for="name" >First Name</label>
                    <input type="text" id="name" class="profile-input" name="first_name">
                    @error('first_name') <span class="text-danger"> {{$message}} </span> @enderror
                </div>
                <div class="profile-div-colunm-right">
                    <label class="profile-lable" for="name">Last Name</label>
                    <input type="text" id="name" class="profile-input" name="last_name">
                    @error('last_name') <span class="text-danger"> {{$message}} </span> @enderror
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-max profile-div-colunm-left2">
                    <label class="profile-lable" for="email">Email Address</label>
                    <input type="text" id="email" class="profile-input" name="email">
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="phone">Phone</label>
                    <input type="text" id="phone" class="profile-input" name="phone">
                    @error('phone') <span class="text-danger"> {{$message}} </span> @enderror
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="organization">Organization</label>
                    <input type="text" id="organization" class="profile-input" name="organization">
                    @error('organization') <span class="text-danger"> {{$message}} </span> @enderror
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="user_type">Access type</label>
                    <select id="user_type" class="profile-input" name="user_type">
                        <option value="NULL"></option>
                        @foreach($user_types as $type)
                            <option value="{{ $type->type_code }}">{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="profile-row">
                <div class="profile-div-colunm-left">

                    <div class="profile-row-inter">
                        <div class="profile-div-max profile-div-colunm-right2">
                            <label class="profile-lable" for="country">User Country</label>
                            <input type="text" id="country" class="profile-input" name="country">
                            @error('country') <span class="text-danger"> {{$message}} </span> @enderror
                        </div>
                    </div>
                </div>


                <div class="profile-div-colunm-right">
                    <div class="profile-row-inter">
                        <div class="profile-div-max profile-div-colunm-right2">
                            <label class="profile-lable" for="city-input">User City</label>
                            <input type="text" id="city" class="profile-input" name="city">
                            @error('city') <span class="text-danger"> {{$message}} </span> @enderror
                        </div>
                    </div>
                </div>

            </div>

            <div class="profile-row">
                <div class="profile-div-max profile-div-colunm-middle">
                    <label class="profile-lable" for="language">User Language</label>
                    <input type="text" id="language" class="profile-input" name="language">
                    @error('country') <span class="text-danger"> {{$message}} </span> @enderror
                </div>

                <div class="profile-div-min profile-div-colunm-right2">
                    <label class="profile-lable" for="language-level">Level</label>
                    <select id="language-level" class="profile-input" name="language-level">
                        <option value="NULL"></option>
                        @foreach($language_levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('language-level')
            <div class="profile-row-list">
                <span class="text-danger"> {{$message}} </span>
            </div>
            @enderror
            @error('language')
            <div class="profile-row-list">
                <span class="text-danger"> {{$message}} </span>
            </div>
            @enderror


            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="repository">User Repository</label>
                    <input type="text" id="repository" class="profile-input" name="repository">
                    <span class="text-danger">@error('repository') {{$message}} @enderror</span>
                </div>
            </div>

            
            <div class="profile-row">
                <div class="profile-div-row">
                    <label class="profile-lable" for="info">User info</label>
                    <textarea id="info" class="profile-input" name="info" style="height: 120px;"></textarea>
                    <span class="text-danger">@error('info') {{$message}} @enderror</span>
                </div>
            </div>


          <div class="profile-row">
              <div class="profile-div-row">
                  <label class="profile-lable" for="url">User Url</label>
                  <input type="text" id="url" class="profile-input" name="url">
                  <span class="text-danger">@error('url') {{$message}} @enderror</span>
              </div>
          </div>


          <div class="profile-row">
              <div class="profile-div-row">
                  <label class="profile-lable" for="messenger">User Messenger</label>
                  <input type="text" id="messenger" class="profile-input" name="messenger">
                  <span class="text-danger">@error('messenger') {{$message}} @enderror</span>
              </div>
          </div>


          <div class="profile-row">
              <div class="profile-div-row">
                  <label class="profile-lable" for="password">User password</label>
                  <input type="password" id="password" class="profile-input" name="password">
                  <span class="text-danger">@error('password') {{$message}} @enderror</span>
              </div>
          </div>

        <div class="form-group" style="margin-top: 10px;">
           <button type="submit" class="btn btn-primary">Create</button>
           <a href="#" onclick="history.back();" class="btn btn-primary">Back</a>
        </div>
          </div> 
</form>



    </div>

  </div>
</section>

@endsection

