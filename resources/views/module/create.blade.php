@extends('layouts.index')

@section('content')
<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Create module</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 box">
            <form action="{{ route('module.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif         
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">name</label>
                    <input type="text" id="name" class="form-control" name="name">
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">description</label>
                    <textarea id="name" class="form-control" name="description"></textarea>
                    <span class="text-danger">@error('description') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_id">Assign to course</label>
                    <select class="form-control" id="course_id" name="course_id">
                        <option value="">Choose course</option>
                        @foreach ($courses_m as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('course_id') {{$message}} @enderror</span>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('module.index') }}" class="btn btn-primary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection