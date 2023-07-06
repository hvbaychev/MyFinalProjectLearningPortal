<?php

namespace App\Http\Controllers;


use App\Http\Requests\CVRequest;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\CourseLogoRequest;
use App\Models\Country;
use App\Models\City;
use App\Models\Course;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LanguageLevel;
use Illuminate\Support\Facades\File;
use App\Events\SendMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;


abstract class AbstractBaseController extends Controller
{

    protected function countriesList()
    {
        $countries = Country::orderBy('name')->get();
        return $countries;
    }

    protected function citiesList()
    {
        $cities = City::orderBy('name')->get();
        return $cities;
    }

    protected function languageLevels()
    {
        $LanguageLevel = LanguageLevel::orderBy('name')->get();
        return $LanguageLevel;
    }

    protected function languagesList()
    {
        $languages = Language::orderBy('name')->get();
        return $languages;
    }

    public function update_avatar(AvatarRequest $request, User $user)
    {
        $avatar = $user->avatar;
        $FilePath = config('app.files_path').'/avatar/';

        if ($avatar != "default_profile.png") {
            File::delete( $FilePath . $avatar);
        }



        $user->avatar = time() . '.' . $request->file('avatar')->extension();
        $result = $request->avatar->move( $FilePath , $user->avatar );

        if ($result) {
            $user->save();
            return redirect()->route('user.profile.edit', ['user' => auth()->user()] )->with('success', 'You have updated your info successfully');
        } else {
            return redirect()->route('user.profile.edit', ['user' => auth()->user()] )->with('fail', 'Something wrong');
        }
        return redirect()->route('user.profile.edit', ['user' => auth()->user()] )->with('fail', 'Something wrong');
    }



    public function update_cv( CVRequest $request, User $user)
    {


        $FilePath = config('app.files_path').'/cv/';
        $user_cv = $user->user_cv;


        if ( $user_cv != null ){
            File::delete($FilePath . $user_cv);
        }

        $user->user_cv = time() . '.' . $request->file('user_cv')->extension();
        $result = $request->user_cv->move($FilePath , $user->user_cv);

        if ( $result ) {
            $user->update();
            return redirect()->route('user.profile.edit', ['user' => auth()->user()] )->with('success', 'You have updated your info successfully');
        } else {
            return redirect()->route('user.profile.edit', ['user' => auth()->user()] )->with('fail', 'Something wrong');
        }
        return redirect()->route('user.profile.edit', ['user' => auth()->user()] )->with('fail', 'Something wrong');
    }


    /**
     * @param CourseLogoRequest $request
     * @param Course $course
     *
     * @return [type]
     */
    public function update_course_logo(CourseLogoRequest $request, Course $course)
    {

        $FilePath = config('app.files_path') . '/course/logo/';
        $course_logo = $course->logo;

        if ($course_logo != null && $course_logo != 'default_logo.jpg') {
            File::delete($FilePath . $course_logo);
        }

        if ($request->hasFile('logo')) {
            $course->logo = time() . '.' . $request->file('logo')->extension();
            $result = $request->logo->move($FilePath, $course->logo);
        }

        if (isset($result) && $result) {
            $course->update();
            return redirect()->route('course.edit', ['course' => $course])->with('success', 'You have updated the logo successfully');
        } else {
            return redirect()->route('course.edit', ['course' => $course])->with('fail', 'Something went wrong');
        }

    }



    public function enrolling(Course $course, User $user) 

    {
        if (Auth::check()) {
            $user = Auth::user();

            $user->courses()->attach($course, ['status' => 'waiting']);

        } else {
            return view('auth.login');
        }

        

        SendMail::dispatch($user, 'course_enrollment_application', null, $course);
        SendMail::dispatch($user, 'course_enrollment_admin_notify', null, $course);

        return redirect()->route('course.show', ['course' => $course])->with('success', 'You have sent an enrollment request');
    }


    

}
