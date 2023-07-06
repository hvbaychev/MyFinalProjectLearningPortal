<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AbstractBaseController;
use App\Events\SendMail;
use App\Models\User;
use App\Models\UserHomeworkTask;
use App\Models\Course;
use App\Models\Grade;
use App\Models\UserType;


class StudentController extends AbstractBaseController
{


    public function index()
    {

        $user = auth()->user();
        if($user && $user->user_type == UserType::BUSINESS_CODE) {

            $users = User::where('user_type', 'student')->whereHas('courses.users', function ($query) {
                $query->where('user_type', 'business');
            })->get();

        } elseif($user && $user->user_type == UserType::STUDENT_CODE) {
            
            $users = $user;

        }else {
            
            $users = User::where('user_type', 'student')->orderBy('id')->get();

        }

        return view('student.index', compact('users'));
    }

    public function show(User $user, Request $request)
    {
        $routeName = Route::currentRouteName();
        
        $request->merge(['user' => $user]);

        $course_logo = $this->getCourseLogo($user);
        $courses = $this->getCourses($user);
        $avg_grade = $this->getGrades($courses, $user);
        
        if ( $routeName == 'user.profile.show' ) {

            return view('user.show_profile', compact('user', 'courses', 'avg_grade'))->with([
                'countries' => $this->countriesList(),
                'cities' => $this->citiesList(),
                'languages' => $this->languagesList(),
            ]);
            
        } else {


            return view('student.show', compact('user'))->with('course_logo', $course_logo)
                                                        ->with('courses', $courses)
                                                        ->with('avg_grade', $avg_grade);

        }
    }

    public function getCourseLogo(User $user) {
        $userHomeworkTask = UserHomeworkTask::where('user_id', $user->id)->first();
    
        if ($userHomeworkTask) {
            $homeworkTask = $userHomeworkTask->homeworkTask;
            $lecture = $homeworkTask->lecture;
            $module = $lecture->module;
            $course = $module->course;
            return $course->logo;
        }

        return null;
    }


    // the courses
    public function getCourses(User $user)
    {   
        $user = auth()->user();

        if($user && $user->user_type == UserType::BUSINESS_CODE) {
            $users = User::where('user_type', 'business')->first();

            $courses = Course::whereHas('users', function ($query) use ($users) {
                $query->where('user_id', $users->id);
            })->get();
        } else {

            $courses = $user->courses()->get();
        }
        
        return $courses;

    }

    // the grades for the courses
    public function getGrades($courses, User $user)
    {
        $lectureIds = [];


        foreach ($courses as $course) {
            foreach ($course->courseModules as $module) {
                foreach ($module->lectures as $lecture) {
                    $lectureIds[] = $lecture->id;
                }
            }
        }


        $grades = Grade::whereIn('lecture_id', $lectureIds)
                    ->where('user_id', $user->id)
                    ->get();

        $grade = $grades->avg('grade');

        $avg_grade = number_format($grade, 2);

        return $avg_grade;
    }



    public function approveList()
    {
        
        $users = User::whereHas('courses', function ($query) {
            $query->where('status', 'waiting');
        })->get();


        foreach ($users as $user) {
            $courses = $user->courses()->where('status', 'waiting')->get();

        }



        return view('profiles.studentFiles.approval', compact('users', 'courses'));
    }


    public function approve( $id )
    {

        $user = User::whereHas('courses', function ($query) use ($id) {
            $query->where('users_courses.id', $id);
        })->first();
        
        if ( $user->user_type == UserType::PUBLIC_CODE) {
            $user->user_type = "student";
            $user->save();
        }

        


        $courseId = $user->courses()->wherePivot('id', $id)->first()->id;
        $user->courses()->updateExistingPivot($courseId, ['status' => 'approved']);

        SendMail::dispatch($user, 'course_enrollment_application_approved', null, $courseId);
        SendMail::dispatch($user, 'course_enrollment_confirmation_admin_notify', null, $courseId);
        
        $course = Course::find($courseId);

        $users = User::whereHas('courses', function ($query) {
            $query->where('status', 'waiting');
        })->get();

        return view('profiles.studentFiles.approval', compact('users'))->with('success', $user->first_name . ' has been enrolled successfully in course: ' . $course->name . '!');
    }

}
