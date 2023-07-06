@extends('layouts.index')


@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Create student</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 box">
            <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif 
                <div class="row">
                    <div class="col-md-12 form-group text-center">
                        <div class="col-md-12 form-group">
                            <img src="{{ url( config('app.files_path').'avatar/default_profile.png') }}" alt="avatar" class="avatar">
                        </div>
                    </div>
                </div>                   
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">First name :</label>
                    <input type="text" id="first_name" class="form-control" name="first_name">
                    <span class="text-danger">@error('first_name') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">Last name :</label>
                    <input type="text" id="last_name" class="form-control" name="last_name">
                    <span class="text-danger">@error('last_name') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">Email :</label>
                    <input type="email" id="email" class="form-control" name="email">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">Password :</label>
                    <input type="text" id="password" class="form-control" name="passwortd">
                    <span class="text-danger">@error('password') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">User type :</label>
                    <input type="text" id="user_type" class="form-control" name="user_type" value="student" readonly>
                    <span class="text-danger">@error('user_type') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">Organization :</label>
                    <input type="text" id="organization" class="form-control" name="organization">
                    <span class="text-danger">@error('organization') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">Phone :</label>
                    <input type="text" id="phone" class="form-control" name="phone">
                    <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">Info :</label>
                    <input type="textarea" id="info" class="form-control" name="info">
                    <span class="text-danger">@error('info') {{$message}} @enderror</span>
                    </div>
                </div>
                {{-- записва се през user->city->name --}}
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">City :</label>
                    <input type="text" id="city_id" class="form-control" name="city_id">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                </div>
                {{-- записва се през user->country->name --}}
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">Country :</label>
                    <input type="text" id="country_id" class="form-control" name="country_id">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                </div>
                {{-- записва се през user->language->name --}}
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">Language :</label>
                    <input type="text" id="language_id" class="form-control" name="language_id">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                </div>
                {{-- записва се през user->language_level->name --}}
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">Language level :</label>
                    <input type="text" id="language_level_id" class="form-control" name="language_level_id">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.txt,.zip,.rar" style="display: none;">
                        <label for="file" id="fileLabel" class="file-label">
                            <img src="{{ url('images/doc-no.png') }}" alt="CV" id="fileImage">
                            <span class="file-label-text">Upload CV</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('student.index') }}" class="btn btn-primary">Back</a>
                <script>
                    document.getElementById('file').addEventListener('change', function() {
                        var fileInput = this;
                        var fileImage = document.getElementById('fileImage');
                        var fileLabel = document.getElementById('fileLabel');
                        var fileLabelText = document.querySelector('.file-label-text');
                        var file = fileInput.files[0];
                        var reader = new FileReader();
                
                        reader.onloadend = function() {
                            fileImage.src = '{{ url('images/doc-ok.png') }}';
                        }
                
                        if (file) {
                            reader.readAsDataURL(file);
                            fileLabelText.textContent = file.name;
                        } else {
                            fileImage.src = '{{ url('images/doc-no.png') }}';
                            fileLabelText.textContent = 'Upload File';
                        }
                    });
                </script>
            </form>
        </div>
    </div>
</div>
</section>
@endsection