@extends('layouts.index')

@section('content')
    <section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
        <div class="container">
            <div class="row align-items-center site-hero-inner2 justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="mb-5 element-animate">
                        <h1>Students</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="course-container">
        @if (count($users) > 0)
            <table class="table student-details">
                <thead>
                    <tr>
                        <th></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <img src="{{ url( config('app.files_path').'avatar/' . auth()->user()->avatar) }}" alt="Avatar" class="avatar_icone">
                            </td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('student.show', $user) }}" class="btn btn-primary">Show</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            @if (auth()->user() && auth()->user()->user_type == 'business')
            <div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
                <br>
                <div class="course-container-index" >
                    <p style="color:white;">No students assigned!</p>
                </div>
            </div>
            @else
            <div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
                <br>
                <div class="course-container-index" >
                    <p style="color:white;">No students found!</p>
                </div>
            </div>
            @endif
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
