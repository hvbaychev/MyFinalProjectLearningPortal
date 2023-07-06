@extends('layouts.index')

@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Edit Homework</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 box">
                <form action="{{ route('homework.update', $homework) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif

                    <!-- homeworkTask -->
                    <div class="col-md-12 form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ $homework->name }}">
                        <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>

                    <!-- homeworkTask -->
                    <div class="col-md-12 form-group">
                        <label for="description">Description:</label>
                        <input type="text" id="description" class="form-control" name="description"  value="{{ $homework->description }}">
                        <span class="text-danger">@error('description') {{$message}} @enderror</span>
                    </div>

                    <!-- lectures -->
                    <div class="col-md-12 form-group">
                        <label for="lecture_id">Select Lecture: </label>
                        <select name="lecture_id" id="lecture_id">
                        <option value="">Select Lecture</option>
                            @foreach($lectures as $lecture)
                            <option value="{{ $lecture->id }}"
                            @if($lecture->id === $homework->lecture_id)
                                selected
                            @endif
                            >Lecture: {{ $lecture->name }} Module: {{ $lecture->module->name }} Course: {{ $lecture->module->course->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('lecture') {{$message}} @enderror</span>
                    </div>


                    <!-- homeworkTask -->
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="file" id="fileLabel" class="file-label">
                                @if(isset($homework->file))
                                <img src="{{ url('images/doc-ok.png') }}" alt="homework" id="fileImage">
                                @else
                                <img src="{{ url('images/doc-no.png') }}" alt="homework" id="fileImage">
                                @endif
                            </label>
                            <span id="fileSpan" class="file-label-text">
                                @if(isset($homework->file))
                                Homework uploaded
                                @else
                                Upload homework
                                @endif
                            </span>
                            <input type="file" id="file" name="file">
                        </div>
                    </div>
                    

                    <script>
                        var fileInput = document.getElementById('file');
                        var fileImage = document.getElementById('fileImage');
                        var fileLabel = document.getElementById('fileSpan');
                    
                        fileInput.addEventListener('change', function() {
                            if (fileInput.files.length > 0) {
                                fileImage.src = '{{ url('images/doc-ok.png') }}';
                                fileLabel.textContent = 'Homework uploaded';
                            } else {
                                fileImage.src = '{{ url('images/doc-no.png') }}';
                                fileLabel.textContent = 'Upload homework';
                            }
                        });
                    
                        window.addEventListener('DOMContentLoaded', function() {
                            if ('{{$homework->student_homework}}' !== '') {
                                fileImage.src = '{{ url('images/doc-ok.png') }}';
                                fileLabel.textContent = 'Homework uploaded';
                            }
                        });
                    </script>



                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('homework.index') }}" class="btn btn-primary">Back</a>
                </form>
            </div>
</section>
@endsection
