@extends('layouts.index')

@section('content')
<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Edit Menu Item : {{ $menuItem->title }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5 box">    
    <form action="{{ route('menuItem.update', $menuItem) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif 
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input id="title" type="text" name="title" class="form-control" value="{{ $menuItem->title }}">
            <span class="text-danger">@error('title') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <label for="url">URL:</label>
            <input id="url" type="text" name="url" class="form-control" value="{{ $menuItem->url }}">
            <span class="text-danger">@error('url') {{$message}} @enderror</span>
        </div>
        <div class="form-group">
            <label for="order">Order:</label>
            <input id="order" type="number" name="order" class="form-control" value="{{ $menuItem->order }}">
            <span class="text-danger">@error('order') {{$message}} @enderror</span>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('menuItem.index') }}" class="btn btn-primary">Back</a>
    </form>
        </div>
      </div>
    </div>
</section>
@endsection
