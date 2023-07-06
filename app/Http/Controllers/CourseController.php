<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\AbstractBaseController;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\UserHomeworkTask;
use App\Models\Lecture;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CourseLogoRequest;
use Illuminate\Support\Facades\DB;
use App\Models\UserType;


class CourseController extends AbstractBaseController
{
    public function index()
    {
        $user = auth()->user(); 
        
        if($user->user_type == UserType::BUSINESS_CODE) {
            
            $courses = $user->courses()
            ->wherePivot('status', 'business')
            ->get();
            
        } elseif($user->user_type == UserType::STUDENT_CODE) {
            
            $courses = $user->courses()->wherePivotIn('status', ['approved', 'waiting'])->get();

        } else {

            $courses = Course::orderBy('id')->get();
        }

        return view('course.index', compact('courses'));
    }

    public function create()
    {

        return view('course.create');
    }

    public function store(CourseRequest $request)
    {
        $course = new Course();
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->duration = $request->input('duration');
        $course->start_date = $request->input('start_date');
        $course->end_date = $request->input('end_date');

        if($request->hasFile('file')) {
            $filePath = config('app.files_path') . '/course/file/';
            $course->file = $request->file('file');
            $fileName = time() . '.' . $course->file->extension();
            $request->file('file')->move($filePath, $fileName);
            $course->file = $fileName;
        }

        $course->save();

        return redirect()->route('course.index')->with('success', 'Course created successfully.');
    }



    public function show(Course $course)
    {
        
        $user = auth()->user();
        $courseId = $course->id;
        $status = null;
        $business_status = null;

        if ($user && $user->user_type == UserType::STUDENT_CODE) {
            
            $student = $user->courses()->where('course_id', $courseId)->first();
            if ($student && in_array($student->pivot->status, ['waiting', 'approved'])) {
                $status = $student->pivot->status;
            }

        } elseif($user && $user->user_type == UserType::BUSINESS_CODE) {

            $business_status = $user->courses()->where('course_id', $courseId)->where('status', 'business')->first();
        } 


        $students = $course->users()->wherePivot('status', ['approved', 'waiting'])->get();
        $lectures = $course->courseModules()->with('lectures')->get()->pluck('lectures')->flatten();
        
        return view('course.show' , [
            'status' => $status,
            'course' => $course,
            'students' => $students,
            'lectures'=> $lectures,
            'business_status' => $business_status
        ]);

    }

    public function getLectures(Course $course) {

        $lectures = Lecture::whereHas('module.course', function ($query) use ($course) {
            $query->where('id', $course->id);
        })->get();

        return $lectures;

    }


    public function edit(Course $course)
    {
        return view('course.edit', compact('course'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->duration = $request->input('duration');
        $course->start_date = $request->input('start_date');
        $course->end_date = $request->input('end_date');

        $uploadedFile = $request->file('file');
        if ($uploadedFile) {
            $filePath = config('app.files_path') . '/course/file/';
            $fileName = time() . '.' . $uploadedFile->extension();
            $uploadedFile->move($filePath, $fileName);
            $course->file = $fileName;
        }

        $course->save();

        return redirect()->route('course.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->courseModules()->delete();

        $course->delete();

        return redirect()->route('course.index')->with('success', 'Course deleted successfully.');
    }


}
