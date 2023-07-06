@extends('layouts.index')

@section('menu')
    @foreach($menuItems as $menuItem)
        <a href="{{ $menuItem->url }}">{{ $menuItem->title }}</a>
    @endforeach

@endsection
