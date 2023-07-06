
@extends('layouts.index')

@section('content')
    <h1>Create grade</h1>
    <form action="{{ route('grade.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">user_id :</label>
            <input type="text" name="user_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="course_id">course_id :</label>
            <input type="text" name="course_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="grade">grade :</label>
            <input type="text" name="grade" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('grade.index') }}" class="btn btn-primary">Back</a>
    </form>
@endsection