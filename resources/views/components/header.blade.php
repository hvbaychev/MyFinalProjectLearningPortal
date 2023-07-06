<header role="banner">
    <nav class="navbar navbar-expand-md navbar-dark bg-light">
        <div class="container">
            <a class="navbar-brand absolute" href="{{ route('home') }}">
                @if(auth()->check())
                    <img src="{{ url( config('app.files_path').'avatar/' . auth()->user()->avatar) }}" alt="Avatar" class="avatar_icone">
                    Hi, {{ auth()->user()->first_name }}
                @else
                    learningportal
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05"
                aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->path() == '/') active @endif" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Courses</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                        @foreach ($courses_m as $course)
                            <a class="dropdown-item" href="{{ route('course.show', $course) }}">{{ $course->name }}</a>
                        @endforeach
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link @if(request()->path() == 'about') active @endif" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->path() == 'contact') active @endif" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>

                @auth
                    <ul class="navbar-nav absolute-right">
                        @if(auth()->user()->user_type == 'admin')
                            <li class="nav-item">
                                <a href="{{ route('admin_rolepanel') }}" class="nav-link">Admin Panel</a>
                            </li>
                        @elseif(auth()->user()->user_type == 'student')
                            <li class="nav-item">
                                <a href="{{ route('student_rolepanel') }}" class="nav-link">Student Panel</a>
                            </li>
                        @elseif(auth()->user()->user_type == 'teacher')
                            <li class="nav-item">
                                <a href="{{ route('teacher_rolepanel') }}" class="nav-link">Teacher Panel</a>
                            </li>
                        @elseif(auth()->user()->user_type == 'business')
                            <li class="nav-item">
                                <a href="{{ route('business_rolepanel') }}" class="nav-link">Business Panel</a>
                            </li>
                        @endif
                        <li class="nav-item @if(str_contains(request()->path(), 'user/edit/profile')) active @endif">
                            <a href="{{ route('user.profile.edit', ['user' => auth()->user()]) }}" class="nav-link">Profile</a>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                        </li>
                    </ul> 
                @endauth

                @guest
                    <ul class="navbar-nav absolute-right">
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>
    </nav>
</header>
