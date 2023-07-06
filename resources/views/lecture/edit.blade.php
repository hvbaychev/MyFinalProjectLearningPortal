@extends('layouts.index')

@section('content')
<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Edit lecture: {{ $lecture->name }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 box">    
    <form action="{{ route('lecture.update', $lecture) }}" method="POST" enctype="multipart/form-data">
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
            <input type="text" name="name" class="form-control" required value="{{ $lecture->name }}">
            <span class="text-danger">@error('name') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <label for="description">description :</label>
            <textarea name="description" class="form-control" required>{{ $lecture->description }}</textarea>
            <span class="text-danger">@error('description') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <label for="lecture_date">lecture date :</label>
            <input type="datetime-local" id="lecture_date" class="form-control" name="lecture_date" value="{{ $lecture->date ? $lecture->date : ''}}">
            <span class="text-danger">@error('lecture_date') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <label for="module_id">Assign to module</label>
            <select class="form-control" id="module_id" name="module_id">
                @if ($lecture->module)
                    <option value="{{ $lecture->module->id }}">{{ $lecture->module->name }}</option>
                @endif
                @foreach ($modules as $module)
                    @if (!($lecture->module) || $module->name !== $lecture->module->name)
                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                    @endif    
                @endforeach
            </select>            
            <span class="text-danger">@error('module_id') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="#" onclick="history.back();" class="btn btn-primary">Back</a>
        </div>
        </div>        
    </form>
        </div>
      </div>
    </div>
</section>
@endsection

