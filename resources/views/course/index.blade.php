@extends('layouts.index')

@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Course list</h1>
                </div>
            </div>
        </div>
    </div>
</section>

@if(auth()->user() && auth()->user()->user_type == 'admin')
<div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
    <br>
    <div class="course-container-index" >
        <a href="{{ route('course.create', ['courses' => $courses]) }}" class="btn btn-primary" style="margin-right: 5px;">Create New Course:</a>
    </div>
</div>
@endif

<div class="course-container">
    @if ($courses->count() > 0)
        <table class="course-details">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>Start date</th>
                    <th>End date</th>
                    @if(auth()->user())
                        <th>Modules</th>
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                
                @php
                    $status = $course->users->find(auth()->user()->id)->pivot->status ?? null;
                @endphp
                

                    <tr>
                        <td>
                            <img src="{{ url(config('app.files_path') . 'course/logo/' . $course->logo) }}" alt="logo" class="course_icon">
                        </td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->duration }}</td>
                        <td>{{ $course->start_date }}</td>
                        <td>{{ $course->end_date }}</td>
                        @if(auth()->user() && auth()->user()->user_type != 'public')
                        <td>
                            <ul>
                                @if($course->courseModules)
                                    @foreach($course->courseModules as $module)
                                        <li>
                                            <a href="{{ route('module.show', [$module->id, $course->id]) }}">{{ $module->name }}</a>
                                        </li>
                                    @endforeach
                                @else
                                    No modules assgined
                                @endif
                            </ul>
                        </td>
                        <td>
                            @if ( $status == "approved" || auth()->user()->user_type != 'public' )
                                <a href="{{ route('course.show', $course) }}" class="btn btn-primary">Show</a>
                            @elseif ( $status == "waiting" )
                                <a href="#" onclick="event.preventDefault();" class="btn btn-secondary">Awaiting<br>approval</a>
                            @else 
                                <a href="#" onclick="event.preventDefault();" class="btn btn-secondary">Not access</a>
                            @endif
                            
                            @if(auth()->user()->user_type == 'admin')
                                <a href="{{ route('course.edit', $course) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('course.destroy', $course) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        @if (auth()->user()->user_type == 'business')
        <div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
            <br>
            <div class="course-container-index" >
                <p style="color:white;">No courses asigned!</p>
            </div>
        </div>
        @else
        <div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
            <br>
            <div class="course-container-index" >
                <p style="color:white;">No courses found!</p>
            </div>
        </div>
        @endif
    @endif
    <div class="back-button">
        @if (auth()->user() && auth()->user()->user_type == 'admin')
            <a href="{{ route('admin_rolepanel') }}" class="btn btn-primary">Back</a>
        @elseif (auth()->user() && auth()->user()->user_type == 'student')
            <a href="{{ route('student_rolepanel') }}" class="btn btn-primary">Back</a>
        @elseif (auth()->user() && auth()->user()->user_type == 'teacher')
            <a href="{{ route('teacher_rolepanel') }}" class="btn btn-primary">Back</a>
        @elseif (auth()->user() && auth()->user()->user_type == 'business')
            <a href="{{ route('business_rolepanel') }}" class="btn btn-primary">Back</a>
            @else
            <a href="{{ route('show_form') }}" class="btn btn-primary">Back</a>
        @endif

    </div>
</div>


@endsection
