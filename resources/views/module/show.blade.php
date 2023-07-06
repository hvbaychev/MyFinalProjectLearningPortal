@extends('layouts.index')

@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Module: {{ $module->name }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
    <br>
    <div class="course-container-show" >
            @if($module->description)
                <p class="username" style="margin-bottom: 5px;">
                    <h4 style="color:white">{{ $module->description }}</h4>
                </p>
            @else
                <p class="username" style="margin-bottom: 5px;">
                    <h4 style="color:white">No description</h4>
                </p>
            @endif
        </div>
    </div>
</div>

<div class="course-container">
    <br>
        <table class="course-details">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Lectures</th>
                    @if(auth()->user()->user_type == 'admin')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>
                            <ul>
                                @if(!empty($module->course))
                                    <li><a href="{{ route('course.show', $module->course->id) }}">{{ $module->course->name }}</a></li>
                                @else
                                    No courses
                                @endif
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @if(!empty($module->lectures))
                                    @foreach($module->lectures as $lecture)
                                        <li><a href="{{ route('lecture.show', ['lecture' => $lecture->id, 'module' => $module->id]) }}">{{ $lecture->name }}</a></li>
                                    @endforeach
                                @else
                                    No lectures assigned
                                @endif
                            </ul>
                        </td>
                        <td>
                            {{-- <a href="{{ route('module.edit', ['module' => $module->id]) }}" class="btn btn-primary">Edit</a> --}}
                            @if(auth()->user()->user_type == 'admin')
                            <a href="{{ route('module.edit', ['module' => $module->id]) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('module.destroy', $module) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
            </tbody>
        </table>
        <div class="back-button">
            @if (request()->is('course*'))
                <a href="{{ route('course.index') }}" class="btn btn-primary">Back</a>
            @elseif (request()->is('lecture*'))
                <a href="{{ route('lecture.index') }}" class="btn btn-primary">Back</a>
            @else
                <a href="{{ route('module.index') }}" class="btn btn-primary">Back</a>
            @endif
        </div>
</div>


@endsection


