@extends('layouts.index')

@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Course: {{ $course->name }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
    <br>
    <div class="course-container-show" >
        <img src="{{ url(config('app.files_path').'course/logo/' . $course->logo) }}" alt="logo" class="course">
        <div style="display: flex; flex-direction: column; align-items: center; margin-top: 10px;">
            @if($course->description)
                <p class="username" style="margin-bottom: 5px;">
                    <h4 style="color:white">{{ $course->description }}</h4>
                </p>
            @endif
        </div>
    </div>
</div>

@if(isset($success))
    <div class="alert alert-success">{{ $success }}</div>
@endif
@if(isset($fail))
    <div class="alert alert-danger">{{ $fail }}</div>
@endif

<div class="course-container">
    <br>
        <h6>Course info:</h6>
        <table class="course-details">
            <thead>
                <tr>
                    <th>Duration</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Modules</th>
                    @if(auth()->user() && auth()->user()->user_type == 'business')
                        <th>Students</th>
                        @endif
                    @if((auth()->user() && auth()->user()->user_type == 'business') || (auth()->user() && auth()->user()->user_type == 'student'))
                        <th>Course enrollment status</th>
                    @endif
                    @if(!auth()->user() || auth()->user()->user_type == 'public')
                        <th>Lectures/schedule</th>
                    @endif
                    @if (auth()->user())
                        <th>File</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{ $course->duration }}</td>
                        <td>{{ $course->start_date }}</td>
                        <td>{{ $course->end_date }}</td>
                        <td>
                            <ul>
                            @if(!empty($course->courseModules))    
                                @foreach ($course->courseModules as $module)
                                <li>
                                    @if((auth()->user() && auth()->user()->user_type != 'public') && ($business_status != null || auth()->user() && auth()->user()->user_type != 'business'))
                                        <a href="{{ route('module.show', [$module->id, $course->id]) }}">{{ $module->name }}</a>
                                    @else
                                    {{ $module->name }}
                                    @endif
                                </li>
                                @endforeach
                            @else
                                <li>No modules assigned</li>
                            @endif
                            </ul>
                        </td>
                        @if(auth()->user() && auth()->user()->user_type == 'business')
                        <td>
                            <ul>
                                @if ($business_status != null)                                    
                                    @if(!empty($students))
                                        @foreach($students as $student)
                                            <li><a href="{{ route('student.show', $student->id) }}">{{ $student->first_name }}</a></li></li>
                                        @endforeach
                                    @else
                                        <li>No students assigned</li>
                                    @endif
                                @else

                                @endif
                            </ul>
                        </td>
                        @endif
                        @if((auth()->user() && auth()->user()->user_type == 'business') || (auth()->user() && auth()->user()->user_type == 'student'))
                        <td>
                            <ul>
                                @if (isset($status))
                                    @if (auth()->user()->user_type == 'business')
                                        @foreach ($status as $status)
                                            <li>{{ $status }}</li>
                                        @endforeach
                                    @else
                                        <li>{{ $status }}</li> 
                                    @endif
                                @else
                                    <li>not enrolled</li>
                                @endif        
                            </ul>
                        </td>
                        @endif
                        @if(!auth()->user() || auth()->user()->user_type == 'public')
                            <td>
                                <ul>
                                    @if(!empty($lectures))
                                        @foreach($lectures as $lecture)
                                            <li>{{ $lecture->name }} - {{ date('d, F Y', strtotime($lecture->date)) }}</li>
                                        @endforeach
                                    @else
                                        <li>No lectures assigned</li>
                                    @endif
                                </ul>
                            </td>
                        @endif
                        <td>
                            @if (isset($course->file) && auth()->user())
                                {{$course->file}}
                            @else
                                No file attached
                            @endif
                        </td>
                    </tr>
            </tbody>
        </table>
</div>

@if (auth()->user() && auth()->user()->user_type == 'public' || auth()->user() && auth()->user()->user_type == 'student')
    @if ( $status == "approved" )
        <a href="#" onclick="event.preventDefault();" class="btn btn-secondary" style="display: flex; justify-content: center; align-items: center;"><h2>Already enrolled in the course</h2></a>
    @elseif ( $status == "waiting" )
        <a href="#" onclick="event.preventDefault();" class="btn btn-secondary" style="display: flex; justify-content: center; align-items: center;"><h2>Awaiting enrollment for the course</h2></a>
    @else
        <a href="{{ route('course.enrolling', ['course' => $course, 'user' => auth()->user()]) }}" class="btn btn-primary" style="display: flex; justify-content: center; align-items: center;"><h2>Enroll in the course</h2></a>            
    @endif
@else
    @if(!auth()->user() || (auth()->user() && !auth()->user()->user_type == 'business'))
        <a href="{{ route('show_form') }}" class="btn btn-primary" style="display: flex; justify-content: center; align-items: center;"><h2>Enroll in the course</h2></a> 
    @endif
@endif

</div>


@if(auth()->user() && !auth()->user()->user_type == 'public')
    <div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
        <br>
        <div class="course-container-show">
            @if($course->file)
                <h5 style="color:white">Download course file:</h5>
            @else
                <h5 style="color:white">No course file attached:</h5>
            @endif
            <div>
                @if( $course->file )
                    <a href="{{ url( config('app.files_path').'course/file/' . $course->file) }}" download="{{ $course->name }}-{{auth()->user()->first_name}}-{{auth()->user()->last_name}}-{{$course->file}}">
                        <img src="{{ url('images/doc-ok.png') }}" alt="CV" class="cv">
                    </a>
                @else
                    <img src="{{ url('images/doc-no.png') }}" alt="CV" class="cv">
                @endif

            </div>
            <div class="back-button">
                <a href="{{ route('course.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    @else
    @if((auth()->user() && auth()->user()->user_type != 'public') && $business_status)
    <div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
        <div class="back-button">
            <a href="{{ route('course.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    @else
    <div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
        <div class="back-button">
            <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    @endif
    
@endif

@endsection

