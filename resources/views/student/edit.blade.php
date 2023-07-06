@extends('layouts.index')

@section('content')
    <h1>Edit user</h1>
    <form action="{{ route('user.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="first_name">first name :</label>
            <input type="text" name="first_name" class="form-control" required value="{{ $user->first_name }}">
        </div>
        <div class="form-group">
            <label for="last_name">last name :</label>
            <input type="text" name="last_name" class="form-control" required value="{{ $user->last_name }}">
        </div>
        <div class="form-group">
            <label for="email">email :</label>
            <input type="email" name="email" class="form-control" required value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="user_type">type :</label>
            <input type="text" name="user_type" class="form-control" required value="{{ $user->user_type }}">
        </div>
        <div class="form-group">
            <label for="password">password :</label>
            <input type="password" name="password" class="form-control" required value="{{ $user->password }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('user.index') }}" class="btn btn-primary">Back</a>
    </form>
@endsection
