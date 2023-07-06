@extends('layouts.index')

@section('content')
   <section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
        <div class="container">
            <div class="row align-items-center site-hero-inner2 justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="mb-5 element-animate">
                        <h1>User list</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

@if(auth()->user() && auth()->user()->user_type == 'admin')
<div class="course-container" style="display: flex; justify-content: center; align-items: center; background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');">
    <br>
    <a href="{{ route('user.create') }}" class="btn btn-primary" style="margin-right: 5px;">Create New User:</a>

        @if ( $noApprovedUsers->count() > 0 )
        <a href="{{ route('students.approve.list') }}" class="btn btn-primary">Waiting for approval : {{ $noApprovedUsers->count() }}</a>
        @endif
</div>
@endif

    <div class="course-container">
        <br>
        @if (count($users) > 0)
            <table class="table course-details">
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
                                @if(isset(auth()->user()->avatar)) 
                                    <img src="{{ url( config('app.files_path').'avatar/' . auth()->user()->avatar) }}" alt="Avatar" class="avatar_icone">                            
                                @else
                                    <img src="{{ url( config('app.files_path').'avatar/' . 'default_profile.png') }}" alt="Avatar" class="avatar_icone">
                                @endif
                            </td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('user.show', $user) }}" class="btn btn-primary">Show</a>
                                @if(auth()->user()->user_type == 'admin')
                                <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('user.destroy', $user) }}" method="POST" style="display:inline">
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
            <p>No menu items found.</p>
        @endif
        <div class="back-button">
        <a href="{{ route('admin_rolepanel') }}" class="btn btn-primary">Back</a>
        </div>
    </div>




@endsection
