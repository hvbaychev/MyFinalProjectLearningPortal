@extends('layouts.index')
@section('content')
<section class="site-hero site-hero-innerpage2" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('images/dashboard/dashboard.jpg') }}'); padding-top: 65px;">
    <div class="container">
        <div class="row align-items-center site-hero-inner2 justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-5 element-animate">
                    <h1>Admin dashoboard</h1>
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
                        <li class="{{ request()->routeIs('module.index') ? 'active' : '' }}"><a href="{{ route('module.index') }}">Modules</a></li>
                        <li class="{{ request()->routeIs('lecture.index') ? 'active' : '' }}"><a href="{{ route('lecture.index') }}">Lectures</a></li>
                    </ul>
                    <ul class="tab-menu">
                        <li class="{{ request()->routeIs('user.index') ? 'active' : '' }}"><a href="{{ route('user.index') }}">Users</a></li>
                        <li class="{{ request()->routeIs('grade.index') ? 'active' : '' }}"><a href="{{ route('grade.index') }}">Grades</a></li>
                        <li class="{{ request()->routeIs('homework.index') ? 'active' : '' }}"><a href="{{ route('homework.index') }}">Homework</a></li>
                    </ul>
                </aside>
                <main class="content">
                    <!-- Courses Tab -->
                    <div id="Courses" class="tab-content {{ request()->routeIs('course.index') ? 'active' : '' }}">
                        <h2>Courses</h2>
                        <!-- Add content for the Trainings tab -->
                    </div>
                    <!-- Courses Tab -->
                    <div id="Modules" class="tab-content {{ request()->routeIs('module.index') ? 'active' : '' }}">
                        <h2>Modules</h2>
                        <!-- Add content for the Trainings tab -->
                    </div>
                    <!-- Courses Tab -->
                    <div id="Lectures" class="tab-content {{ request()->routeIs('lecture.index') ? 'active' : '' }}">
                        <h2>Lectures</h2>
                        <!-- Add content for the Trainings tab -->
                    </div>
                    <!-- Users Tab -->
                    <div id="Users" class="tab-content {{ request()->routeIs('user.index') ? 'active' : '' }}">
                        <h2>Users</h2>
                        <!-- Add content for the Trainings tab -->
                    </div>
                    <!-- Grades Tab -->
                    <div id="Grades" class="tab-content {{ request()->routeIs('grade.index') ? 'active' : '' }}">
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
