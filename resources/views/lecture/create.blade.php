@extends('layouts.index')

@section('content')
<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Create lecture</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 box">
            <form action="{{ route('lecture.store') }}" method="POST" enctype="multipart/form-data">
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
                <div class="row">
                    <div class="col-md-12 form-group">
                    <label for="name">lecture date</label>
                    <input type="datetime-local" id="lecture_date" class="form-control" name="lecture_date">
                    <span class="text-danger">@error('lecture_date') {{$message}} @enderror</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="module_id">Assign to module</label>
                    <select class="form-control" id="module_id" name="module_id">
                        <option value="">Choose module</option>
                        @foreach ($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('module_id') {{$message}} @enderror</span>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('lecture.index') }}" class="btn btn-primary">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection