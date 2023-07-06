@extends('layouts.index')

@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Modules list</h1>
                </div>
            </div>
        </div>
    </div>
</section>

@if(auth()->user() && auth()->user()->user_type == 'admin')
<div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
    <br>
    <div class="course-container-index" >
        <a href="{{ route('module.create') }}" class="btn btn-primary" style="margin-right: 5px;">Create New Module:</a>
    </div>
</div>
@endif

<div class="course-container">
    @if ($modules->count() > 0)
        <table class="course-details">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Lectures</th>
                    <th>Courses</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modules as $module)
                    <tr>
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->description }}</td>
                        <td>
                            <ul>
                                @if($module->lectures)
                                    @foreach ($module->lectures as $lecture)
                                        <li><a href="{{ route('lecture.show', ['lecture' => $lecture->id, 'module' => $module]) }}">{{ $lecture->name }}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                        <td>
                            @if($module->course)
                                <a href="{{ route('course.show', $module->course->id) }}">{{ $module->course->name }}</a>
                            @else
                                Not assigned to course yet
                            @endif
                        </td>
                        <td>
                            @if(auth()->user()->user_type == 'admin')
                                <a href="{{ route('module.edit', $module) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('module.destroy', $module) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="{{ route('module.show', ['module' => $module, 'course' => $module->course]) }}" class="btn btn-primary">Show</a>
                            @else
                                <a href="{{ route('module.show', ['module' => $module, 'course' => $module->course]) }}" class="btn btn-primary">Show</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No courses found.</p>
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

