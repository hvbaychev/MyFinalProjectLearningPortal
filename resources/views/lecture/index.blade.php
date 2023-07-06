@extends('layouts.index')

@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Lectures list</h1>
                </div>
            </div>
        </div>
    </div>
</section>

@if(auth()->user() && auth()->user()->user_type == 'admin')
<div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
    <br>
    <div class="course-container-index" >
        <a href="{{ route('lecture.create') }}" class="btn btn-primary" style="margin-right: 5px;">Create New Lecture:</a>
    </div>
</div>
@endif

<div class="course-container">
    @if (count($lectures) > 0)
        <table class="course-details">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Module</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lectures as $lecture)
                    <tr>
                        <td>{{ $lecture->name }}</td>
                        <td>{{ $lecture->description }}</td>
                        <td>
                                @if($lecture->module)
                                        <a href="{{ route('module.show', ['module' => $lecture->module->id, 'course' => $lecture->module->course->id]) }}">{{ $lecture->module->name }}</a>
                                @endif
                        </td>
                        <td>
                            @if($lecture->module->course)
                                <a href="{{ route('course.show', ['course' => $lecture->module->course->id]) }}">{{ $lecture->module->course->name }}</a>
                            @else
                                Not assigned to course yet
                            @endif
                        </td>
                        <td>
                            @if(auth()->user()->user_type == 'admin')
                                <a href="{{ route('lecture.edit', $lecture) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('lecture.destroy', $lecture) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="{{ route('lecture.show', ['lecture' => $lecture, 'module' => $lecture->module]) }}" class="btn btn-primary">Show</a>
                            @else
                                <a href="{{ route('lecture.show', ['lecture' => $lecture, 'module' => $lecture->module]) }}" class="btn btn-primary">Show</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No lectures found.</p>
    @endif
    <div class="back-button">
        @if (auth()->user()->user_type == 'admin')
            <a href="{{ route('admin_rolepanel') }}" class="btn btn-primary">Back</a>
        @elseif (auth()->user()->user_type == 'student')
            <a href="{{ route('student_rolepanel') }}" class="btn btn-primary">Back</a>
        @elseif (auth()->user()->user_type == 'teacher')
            <a href="{{ route('teacher_rolepanel') }}" class="btn btn-primary">Back</a>
        @elseif (auth()->user()->user_type == 'business')
            <a href="{{ route('business_rolepanel') }}" class="btn btn-primary">Back</a>
        @endif

    </div>
</div>


@endsection

