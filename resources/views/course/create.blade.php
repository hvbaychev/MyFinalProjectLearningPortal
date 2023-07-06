@extends('layouts.index')

@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Create course</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 box">
            <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
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
                            <img src="{{ url( config('app.files_path').'course/logo/default_logo.jpg') }}" alt="logo" class="course">
                        </div>
                    </div>
                </div>
                <div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">name</label>
                    <input type="text" id="name" class="form-control" name="name">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">description</label>
                    <textarea id="name" class="form-control" name="description"></textarea>
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">duration</label>
                    <input type="text" id="name" class="form-control" name="duration">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">srart date</label>
                    <input type="date" id="name" class="form-control" name="start_date">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">end date</label>
                    <input type="date" id="name" class="form-control" name="end_date">
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.txt,.zip,.rar" style="display: none;">
                        <label for="file" id="fileLabel" class="file-label">
                            <img src="{{ url('images/doc-no.png') }}" alt="CV" id="fileImage">
                            <span class="file-label-text">Upload File</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('course.index') }}" class="btn btn-primary">Back</a>
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
