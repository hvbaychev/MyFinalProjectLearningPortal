@extends('layouts.index')

@section('content')
   <section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
        <div class="container">
            <div class="row align-items-center site-hero-inner2 justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="mb-5 element-animate">
                        <h1>Menu list</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="course-container">
        <a href="{{ route('menuItem.create') }}" class="btn btn-primary">Create New Menu Item :</a>
    <br>
    @if (count($menuItems) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menuItems as $menuItem)
                    <tr>
                        <td>{{ $menuItem->title }}</td>
                        <td>{{ $menuItem->url }}</td>
                        <td>{{ $menuItem->order }}</td>
                        <td>
                            <a href="{{ route('menuItem.show', $menuItem) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('menuItem.edit', $menuItem) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('menuItem.destroy', $menuItem) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>No menu items found.</p>
    @endif
    <div class="back-button" style="margin-bottom: 15px;">
        @if (auth()->user()->user_type == 'admin')
            <a href="{{ route('admin_rolepanel') }}" class="btn btn-primary">Back</a>
        @endif
    </div>


@endsection

