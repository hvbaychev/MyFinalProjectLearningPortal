    @extends('layouts.index')

    @section('content')

    <section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
        <div class="container">
            <div class="row align-items-center site-hero-inner2 justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="mb-5 element-animate">
                        <h1>Lecture: {{ $lecture->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
        <br>
        <div class="course-container-show" >
                @if($lecture->description)
                    <p class="username" style="margin-bottom: 5px;">
                        <h4 style="color:white;">{{ $lecture->description }}</h4>
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
                        <th>Module</th>
                        <th>Schedule</th>
                        <th>File</th>
                        @if(auth()->user()->user_type == 'admin')
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>
                                <ul>
                                    @if($lecture->module->course)
                                        <a href="{{ route('course.show', $lecture->module->course->id) }}">{{ $lecture->module->course->name }}</a>
                                    @else
                                        No courses
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @if($lecture->module)
                                        <a href="{{ route('module.show', ['module' => $lecture->module->id, 'course' => $lecture->module->course->id]) }}">{{ $lecture->module->name }}</a>
                                    @else
                                        No lectures
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @if(!empty($lecture->date))
                                       <li>{{ date('d, F Y', strtotime($lecture->date)) }}</li>
                                    @else
                                        No schedule added
                                    @endif
                                </ul>
                            </td>
                            <td>
                                @if(isset($lecture->file))
                                    {{ $lecture->file }}
                                @else
                                    No file attached
                                @endif
                            </td>
                            <td>
                                @if(auth()->user()->user_type == 'admin')
                                    <a href="{{ route('lecture.edit', ['lecture' => $lecture]) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('lecture.destroy', ['lecture' => $lecture]) }}" method="POST" style="display:inline">
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
                @elseif (request()->is('module*'))
                    <a href="{{ route('module.index') }}" class="btn btn-primary">Back</a>
                @else
                    <a href="{{ route('lecture.index') }}" class="btn btn-primary">Back</a>
                @endif
            </div>
    </div>


    @endsection


