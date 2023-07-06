@extends('layouts.index')

@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Homework details</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 box">

                <!-- homework file -->
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="fileDownload" id="fileLabelDownload" class="file-label">
                            @if( $homework->file )
                                <img src="{{ url('images/doc-ok.png') }}" alt="homework" class="homework">
                                <a href="{{ url( config('app.files_path').'homework/' . $homework->file) }}" download="{{$user->first_name}}-{{$user->last_name}}-{{$homework->file}}" class="btn btn-primary button-class">
                                    Download homework task
                                </a>
                                
                                @else
                                <img src="{{ url('images/doc-no.png') }}" alt="homework" class="homework non-clickable" onclick="return false;" style="pointer-events: none;">
                                <span class="file-label-text">No homework file for download</span>
                            @endif
                        </label>
                    </div>
                </div>

                <!-- homeworkTask -->
                <div class="col-md-12 form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ $homework->name }}" readonly>
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                </div>

                <!-- homeworkTask -->
                <div class="col-md-12 form-group">
                    <label for="description">Description:</label>
                    <input type="text" id="description" class="form-control" name="description" value="{{ $homework->description }}" readonly>
                    <span class="text-danger">@error('description') {{$message}} @enderror</span>
                </div>

                <!-- lectures -->
                <div class="col-md-12 form-group">
                    <label for="Lecture">Lecture:</label>
                    <input type="text" id="Lecture" class="form-control" name="Lecture" value="{{ $homework->lecture->name }}" readonly>
                    <span class="text-danger">@error('lecture') {{$message}} @enderror</span>
                </div>

                <!-- module -->
                <div class="col-md-12 form-group">
                    <label for="Lecture">Module:</label>
                    <input type="text" id="Lecture" class="form-control" name="Lecture" value="{{ $homework->lecture->module->name }}" readonly>
                    <span class="text-danger">@error('lecture') {{$message}} @enderror</span>
                </div>

                <!-- course -->
                <div class="col-md-12 form-group">
                    <label for="Lecture">Course:</label>
                    <input type="text" id="Lecture" class="form-control" name="Lecture" value="{{ $homework->lecture->module->course->name }}" readonly>
                    <span class="text-danger">@error('lecture') {{$message}} @enderror</span>
                </div>


                @if (auth()->user() && auth()->user()->user_type == 'student')
                
                <form action="{{ route('homework.uploadFile', ['homework' => $homework]) }}" method="POST" enctype="multipart/form-data"> 
                    
                    @csrf
                    @method('POST')
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


                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="file" id="fileLabel" class="file-label">
                                @if(isset($user_homework_task->student_homework))
                                <img src="{{ url('images/doc-ok.png') }}" alt="homework" id="fileImage">
                                @else
                                <img src="{{ url('images/doc-no.png') }}" alt="homework" id="fileImage">
                                @endif
                            </label>
                            <span id="fileSpan" class="file-label-text">
                                @if(isset($user_homework_task->student_homework))
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

                    
                    <button type="submit" class="btn btn-primary button-class">Upload homework</button>

                </form>
                @else

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="fileDownload" id="fileLabelDownload" class="file-label">
                            @if( isset($user_homework_task->student_homework) )
                                <img src="{{ url('images/doc-ok.png') }}" alt="homework" class="homework">
                                <a href="{{ url( config('app.files_path').'homework/' . $user_homework_task->student_homework) }}" download="{{$user->first_name}}-{{$user->last_name}}-{{$homework->file}}" class="btn btn-primary button-class">
                                    Download student homework
                                </a>
                                
                                @else
                                <img src="{{ url('images/doc-no.png') }}" alt="homework" class="homework non-clickable" onclick="return false;" style="pointer-events: none;">
                                <span class="file-label-text">No student homework file for download</span>
                            @endif
                        </label>
                    </div>
                </div>

                @endif

                <div>
                    <br>
                    <br>
                <a href="{{ route('homework.index') }}" class="btn btn-primary">Back</a>
                </div>
                </form>
            </div>
</section>
@endsection
