@extends('layouts.index')

@section('content')

<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Student: {{ $user->first_name }} {{ $user->last_name }} </h1>
                </div>
            </div>
        </div>
    </div>
</section>




<section style="align-items: center;">

@if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    <div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
        <br>
        <div class="avatar-container">
            <img src="{{ url( config('app.files_path').'avatar/' . auth()->user()->avatar) }}" alt="Avatar" class="avatar">
            <div style="display: flex; flex-direction: column; align-items: center; margin-top: 10px;">
                @if($user->phone)
                    <p class="username" style="margin-bottom: 5px;">
                        Phone: <h4 style="color:white">{{ $user->phone }}</h4>
                    </p>
                @endif
                @if ($user->email)
                    <p class="username" style="margin-bottom: 5px;">
                        Email: <h4 style="color:white">{{ $user->email }}</h4>
                    </p>
                @endif
            </div>
        </div>
    </div>



    <div class="course-container">
        <br>
            <div>
                <h5>Personal information:</h5>
            </div>
            <table class="course-details">
                <thead>
                    <tr>
                        <th>Info</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Language</th>
                        <th>Language level</th>
                        <th>Skills</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>
                                @if(isset($user->info))
                                    {{ $user->info }}
                                @else
                                    No info provided
                                @endif
                            </td>
                            <td>
                                @if(isset($user->city))
                                    {{ $user->city->name }}
                                @else
                                    No info provided
                                @endif
                            </td>
                            <td>
                                @if(isset($user->country))
                                    {{ $user->country->name }} 
                                @else 
                                    No info provided 
                                @endif
                            </td>
                            <td>
                                <ul>
                                    @if(isset($user->userLanguages))
                                        @foreach ($user->userLanguages as $userLanguage)
                                            <li>{{ $userLanguage->language->name }}</li>
                                        @endforeach
                                    @else
                                        No info provided
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @if(isset($user->userLanguages))
                                        @foreach ($user->userLanguages as $userLanguage)
                                            <li>{{ $userLanguage->level->name }}</li>
                                    @endforeach
                                @else
                                    No info provided
                                @endif
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @if (isset($user->skills))
                                        @foreach($user->skills as $skill)
                                            <li>{{ $skill->description }}</li>
                                        @endforeach
                                    @else
                                        No info provided
                                    @endif
                                </ul>
                            </td>
                        </tr>
                </tbody>
            </table>
    </div>


    <div class="course-container">
        <br>
            <div>
                <h5>Courses and performance:</h5>
            </div>
            <table class="course-details">
                <thead>
                    <tr>
                        <th></th>
                        <th>Course</th>
                        <th>Lectures attended</th>
                        <th>Average grade</th>
                        <th>CV</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>
                                @if($course_logo != null)
                                    <img src="{{ url(config('app.files_path') . 'course/logo/' . $course_logo) }}" alt="logo" class="course_icon">
                                @else
                                    <img src="{{ url(config('app.files_path') . 'course/logo/' . 'default_logo.jpg') }}" alt="logo" class="course_icon">
                                @endif
                            </td>
                            <td>
                                <ul>
                                    @if(isset($courses))
                                        @if(auth()->user() && auth()->user()->user_type == 'business')
                                            @foreach ($business_courses as $b_course)
                                                @foreach ($courses as $course)
                                                    @if($b_course->name == $course->name)
                                                        <li><a href="{{ route('course.show', $course) }}">{{ $course->name }}</a></li>
                                                    @endif    
                                                @endforeach    
                                            @endforeach
                                        @else
                                            @foreach($courses as $course)
                                                <li><a href="{{ route('course.show', $course) }}">{{ $course->name }}</a></li>
                                            @endforeach
                                        @endif
                                    @else
                                        No participation
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @foreach ($business_courses as $userCourse)
                                        @foreach ($courses as $course)
                                            @foreach ($course->courseModules as $module)
                                                @foreach ($module->lectures as $lecture)
                                                    @if ($userCourse->id == $course->id)
                                                        <li><a href="{{ route('lecture.show', ['lecture' => $lecture->id, 'module' => $module->id]) }}">{{ $lecture->name }}</a></li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @if(isset($avg_grade) && $avg_grade != 0)
                                        <li><a href="{{ route('grade.index') }}">{{ $avg_grade }}</a></li> 
                                    @else
                                        <li>No grade reported</li>
                                    @endif    
                                </ul>
                            </td>
                            <td>
                                @if( $user->user_cv )
                                    <a href="{{ url( config('app.files_path').'cv/' . $user->user_cv) }}" download="{{ $user->first_name }}-{{ $user->last_name }}-{{ $user->user_cv }}">
                                    <img src="{{ url('images/doc-ok.png') }}" alt="CV" class="cv">
                                </a>
                                @else
                                    <img src="{{ url('images/doc-no.png') }}" alt="CV" class="cv">
                                @endif
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
        <div class="back-button" style="margin-bottom: 20px;">
            <a href="{{ route('student.index') }}" class="btn btn-primary">Back</a>
        </div>
</section>
@endsection
