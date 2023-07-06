@extends('layouts.index')

@section('content')
<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Edit course: {{ $course->name }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 box">    
            
            <form action="{{ route('course.update_logo', ['course' => $course]) }}" method="post" enctype="multipart/form-data" id="update_logo">
                @method('PUT')
                @csrf
                <div class="col-md-12 form-group text-center">
                    <label class="profile-lable" for="logo"></label>
                    <a href="#" onclick="document.getElementById('logo_browse').click(); return false;">
                        <img src="{{ url(config('app.files_path').'course/logo/' . $course->logo) }}" alt="logo" class="course"> 
                    </a>
                    <input type="file" name="logo" id="logo_browse" accept="image/*" style="display: none;">
                    <input type="submit" value="Upload logo" class="btn btn-primary" id="submitButton" style="display: none;">
                    <span class="file-label-text">Update logo</span>
                    <script>
                        document.getElementById('logo_browse').addEventListener('change', function() {
                            document.getElementById('submitButton').click();
                        });
                    </script>
                </div>
            </form>
    <form action="{{ route('course.update', ['course' => $course]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif 
        @method('PUT')

        <div class="form-group">
            <label for="name">name :</label>
            <input type="text" name="name" class="form-control" required value="{{ $course->name }}">
            <span class="text-danger">@error('email') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <label for="description">description :</label>
            <textarea name="description" class="form-control" required>{{ $course->description }}</textarea>
            <span class="text-danger">@error('email') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <label for="duration">duration :</label>
            <input type="text" name="duration" class="form-control" required value="{{ $course->duration }}">
            <span class="text-danger">@error('email') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <label for="start_date">start date :</label>
            <input type="date" name="start_date" class="form-control" required value="{{ $course->start_date }}">
            <span class="text-danger">@error('email') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <label for="end_date">end date :</label>
            <input type="date" name="end_date" class="form-control" required value="{{ $course->end_date }}">
            <span class="text-danger">@error('email') {{$message}} @enderror</span>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="file" id="fileLabel" class="file-label">
                    @if($course->file)
                        <img src="{{ url('images/doc-ok.png') }}" alt="CV" id="fileImage">
                        <span class="file-label-text">Update File</span>
                        <span class="file-name" id="fileName">{{ $course->file }}</span>
                    @else
                        <img src="{{ url('images/doc-no.png') }}" alt="CV" id="fileImage">
                        <span class="file-label-text">Upload File</span>
                        <span class="file-name" id="fileName"></span>
                    @endif
                </label>
                <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.txt,.zip,.rar" style="display: none;">
            </div>
        </div>
        <script>
            document.getElementById('file').addEventListener('change', function() {
                var fileInput = this;
                var fileImage = document.getElementById('fileImage');
                var fileLabelText = document.querySelector('.file-label-text');
                var fileNameElement = document.getElementById('fileName');
                var file = fileInput.files[0];
                var reader = new FileReader();
        
                reader.onloadend = function() {
                    fileImage.src = '{{ url('images/doc-ok.png') }}';
                }
        
                if (file) {
                    reader.readAsDataURL(file);
                    fileLabelText.textContent = 'Update File';
                    fileNameElement.textContent = file.name;
                } else {
                    fileImage.src = '{{ url('images/doc-no.png') }}';
                    fileLabelText.textContent = 'Upload File';
                    fileNameElement.textContent = '';
                }
            });
        
            document.getElementById('fileLabel').addEventListener('click', function() {
                document.getElementById('file').click();
            });
        </script>

        
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('course.index') }}" class="btn btn-primary">Back</a>
    </form>
        </div>
      </div>
    </div>
</section>
@endsection
