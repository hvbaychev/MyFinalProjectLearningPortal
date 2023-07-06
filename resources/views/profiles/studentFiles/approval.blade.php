@extends('layouts.index')

@section('content')
   <section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
        <div class="container">
            <div class="row align-items-center site-hero-inner2 justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="mb-5 element-animate">
                        <h1>User list for approval</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="course-container">

        @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif

        @if(isset($success))
            <div class="alert alert-success">{{ $success }}</div>
        @endif
        
        @if (count($users) > 0)
            <table class="table course-details">
                <thead>
                    <tr>
                        <th></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Access type</th>
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
                            <td>{{ $user->user_type }}</td>
                            <td>
                                
                                @if(auth()->user() && auth()->user()->user_type == 'admin')

                                @foreach ($courses as $course)

                                    <!-- Course ID: {{ $course->id }} - Pivot ID: {{ $course->pivot->id }} - {{ $course->name }} - {{ $course->pivot->status }} -->
                                
                                    @if ($course->pivot->status == 'waiting')
                                        <form action="{{ route('student.approve', $course->pivot->id) }}" method="POST" style="margin-bottom: 10px;">
                                            @csrf
                                            @method('put')
                                            <button type="submit" class="btn btn-primary">Approve enroll for {{ $course->name }}</button>
                                        </form>
                                    @endif
                                    {{-- <!-- <form action="{{ route('student.approve', $course->pivot->id) }}" method="POST" style=" margin-bottom: 10px;">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-primary">Approve enroll for {{ $course->name }}</button>
                                    </form> --> --}}
                                
                                @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No menu items found.</p>
        @endif
        <div class="back-button">
            <a href="{{ route('user.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>




@endsection
