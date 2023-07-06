@extends('layouts.index')
@section('content')
<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}');padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Business dashoboard</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="site-hero overlay" data-stellar-background-ratio="0.5" style="background-image:  url('{{ url('images/dashboard/admin/background.jpg') }}');">
    <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate"></div>
                <aside class="sidebar">
                    <!-- Sidebar content goes here -->
                    <ul class="tab-menu">
                        <li class="{{ request()->routeIs('course.index') ? 'active' : '' }}"><a href="{{ route('course.index') }}">Courses</a></li>
                        <li class="{{ request()->routeIs('student.index') ? 'active' : '' }}"><a href="{{ route('student.index') }}">Students</a></li>
                        <li class="{{ request()->routeIs('grade.index') ? 'active' : '' }}"><a href="{{ route('grade.index') }}">Grades</a></li>
                    </ul>
                </aside>
                <main class="content">
                    <!-- Courses Tab -->
                    <div id="trainings" class="tab-content {{ request()->routeIs('course.index') ? 'active' : '' }}">
                        <h2>Courses</h2>
                        <!-- Add content for the Trainings tab -->
                    </div>
                    <!-- Students Tab -->
                    <div id="students" class="tab-content {{ request()->routeIs('student.index') ? 'active' : '' }}">
                        <h2>Students</h2>
                        <!-- Add content for the Students tab -->
                    </div>
                    <!-- Grades Tab -->
                    <div id="grades" class="tab-content {{ request()->routeIs('grade.index') ? 'active' : '' }}">
                        <h2>Grades</h2>
                        <!-- Add content for the Grades tab -->
                    </div>
                </main>
            </div>
        </div>
    </div>
</section>
<!-- Sidebar -->
@endsection
