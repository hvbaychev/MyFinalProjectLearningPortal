@extends('layouts.index')

@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Menu item: {{ $menuItem->title }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="course-container">
    <br>
        <table class="course-details">
            <thead>
                <tr>
                    <th>Title </th>
                    <th>Url</th>
                    <th>Order</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $menuItem->title }}</td>
                    <td>{{ $menuItem->url }}</td>
                    <td>{{ $menuItem->order }}</td>        
                </tr>
            </tbody>
        </table>
    
        <div class="back-button">
            <a href="{{ route('menuItem.index') }}" class="btn btn-primary">Back</a>
        </div>
   
</div>


@endsection