@extends('layouts.index')

@section('content')

    <h1>Grade Details</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Attribute</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grade->getAttributes() as $attribute => $value)
            <tr>
                <td>{{ $attribute }}</td>
                <td>{{ $value }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('grade.index') }}" class="btn btn-primary">Back</a>
@endsection