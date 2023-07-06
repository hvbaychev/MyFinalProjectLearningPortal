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

class BaseController extends Controller
{

    public function countriesList()
    {
        $countries = Country::orderBy('name')->get();
        return response()->json($countries);
    }

    public function citiesList()
    {
        $cities = City::orderBy('name')->get();
        return response()->json($cities);
    }

    public function languageLevels()
    {
        $languageLevels = LanguageLevel::orderBy('name')->get();
        return response()->json($languageLevels);
    }

    public function languagesList()
    {
        $languages = Language::orderBy('name')->get();
        return response()->json($languages);
    }

    public function updateAvatar(AvatarRequest $request, User $user)
    {
        $avatar = $user->avatar;
        $filePath = config('app.files_path') . '/avatar/';

        if ($avatar != "default_profile.png") {
            File::delete($filePath . $avatar);
        }

        $user->avatar = time() . '.' . $request->file('avatar')->extension();
        $result = $request->avatar->move($filePath, $user->avatar);

        if ($result) {
            $user->save();
            return response()->json(['message' => 'Avatar updated successfully']);
        } else {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function updateCV(CVRequest $request, User $user)
    {
        $filePath = config('app.files_path') . '/cv/';
        $userCv = $user->user_cv;

        if ($userCv != null) {
            File::delete($filePath . $userCv);
        }

        $user->user_cv = time() . '.' . $request->file('user_cv')->extension();
        $result = $request->user_cv->move($filePath, $user->user_cv);

        if ($result) {
            $user->update();
            return response()->json(['message' => 'CV updated successfully']);
        } else {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function updateCourseLogo(CourseLogoRequest $request, Course $course)
    {
        $filePath = config('app.files_path') . '/course/logo/';
        $courseLogo = $course->logo;

        if ($courseLogo != null && $courseLogo != 'default_logo.jpg') {
            File::delete($filePath . $courseLogo);
        }

        if ($request->hasFile('logo')) {
            $course->logo = time() . '.' . $request->file('logo')->extension();
            $result = $request->logo->move($filePath, $course->logo);
        }

        if (isset($result) && $result) {
            $course->update();
            return response()->json(['message' => 'Course logo updated successfully']);
        } else {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function enrolling(Course $course)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->courses()->attach($course, ['status' => 'waiting']);
        } else {
            return response()->json(['message' => 'Please log in to enroll'], 401);
        }

        return response()->json(['message' => 'Enrollment request sent']);
    }

}
