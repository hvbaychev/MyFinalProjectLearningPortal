@extends('layouts.index')

@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Homework list</h1>
                </div>
            </div>
        </div>
    </div>
</section>

@if(auth()->user() && auth()->user()->user_type == 'admin' || auth()->user() && auth()->user()->user_type == 'teacher')
<div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
    <br>
    <div class="course-container-index">
        <a href="{{ route('homework.create') }}" class="btn btn-primary" style="margin-right: 5px;">Create New Homework:</a>
    </div>
</div>
@endif

<div class="course-container">

    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif 

    @if ($homeworks->count() > 0)
        <table class="course-details">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Lecture</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($homeworks as $homework)
                <tr>
                    <td>
                        {{ $homework->name }}
                    </td>
                    <td>
                        @if(isset($homework->description))
                            {{$homework->description}}
                        @else
                            No information provided
                        @endif
                    </td>
                    <td>
                        @if(isset($homework->lecture->name))
                            <a href="{{ route('lecture.show', ['lecture' => $homework->lecture, 'module' => $homework->lecture->module]) }}"> {{ $homework->lecture->name }}</a>
                        @else
                            No information provided
                        @endif
                    </td>
                    <td>
                        @if (isset($homework->lecture->module->course))
                            <a href="{{ route('course.show', ['course' => $homework->lecture->module->course]) }}">{{ $homework->lecture->module->course->name }}</a>      
                        @else
                            No information provided
                        @endif
                    </td>
                    <td>
                        
                        <a href="{{ route('homework.show', $homework) }}" class="btn btn-primary">Show</a>
                        @if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'teacher' )
                            <a href="{{ route('homework.edit', $homework) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('homework.destroy', $homework) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No homeworks found.</p>
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

