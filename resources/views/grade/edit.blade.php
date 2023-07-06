@extends('layouts.index')

@section('content')
    <h1>Edit grade</h1>
    <form action="{{ route('grade.update', $grade) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">user_id :</label>
            <input type="text" name="user_id" class="form-control" required value="{{ $grade->user_id }}">
        </div>
        <div class="form-group">
            <label for="course_idn">course_id :</label>
            <input type="text" name="course_id" class="form-control" required value="{{ $grade->course_id }}">
        </div>
        <div class="form-group">
            <label for="grade">grade :</label>
            <input type="text" name="grade" class="form-control" required value="{{ $grade->grade }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('grade.index') }}" class="btn btn-primary">Back</a>
    </form>
@endsection
