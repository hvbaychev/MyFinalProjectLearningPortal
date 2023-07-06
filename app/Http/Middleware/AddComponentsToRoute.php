<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\AbstractBaseController;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\LanguageLevel;
use App\Models\UserType;
use App\Models\User;
use App\Models\HomeworkTask;
use Illuminate\Support\Facades\Auth;


class AddComponentsToRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $courses_m = Course::orderBy('id')->get();
        $modules = CourseModule::orderBy('id')->get();
        $language_levels = LanguageLevel::orderBy('id')->get();
        $user_types = UserType::orderBy('id')->get();

        $business_courses = Course::whereHas('users', function ($query) {
            $query->where('user_type', 'business');
        })->get();


        view()->share('courses_m', $courses_m);
        view()->share('modules', $modules);
        view()->share('language_levels', $language_levels);
        view()->share('user_types', $user_types);
        view()->share('business_courses', $business_courses);

        return $next($request);
    }
}
