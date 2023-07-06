<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\AbstractBaseController;
use App\Http\Requests\LectureRequest;
use App\Models\Lecture;
use App\Models\Grade;
use App\Models\HomeworkTask;
use App\Models\CourseModule;
use App\Models\UserType;

class LectureController extends AbstractBaseController
{
    public function index()
    {

        $user = auth()->user();

        if($user && $user->user_type == UserType::BUSINESS_CODE) {

            $user_courses = $user->courses()
                ->wherePivot('status', 'business')
                ->get();


                $lectures = [];
                foreach ($user_courses as $user_course) {
                    foreach ($user_course->courseModules as $module) {
                        foreach ($module->lectures as $lecture) {
                            $lectures[] = $lecture;
                        }
                    }
                }


        } elseif($user && $user->user_type == UserType::STUDENT_CODE) {

            $user_courses = $user->courses()->wherePivotIn('status', ['approved', 'waiting'])->get();

            $lectures = [];
                foreach ($user_courses as $user_course) {
                    foreach ($user_course->courseModules as $module) {
                        foreach ($module->lectures as $lecture) {
                            $lectures[] = $lecture;
                        }
                    }
                }

        } else {

            $lectures = Lecture::orderBy('id')->get();
        }

        return view('lecture.index', compact('lectures'));
    }

    public function create()
    {

        $modules = CourseModule::all();
        return view('lecture.create', ['modules' => $modules]);
    }

    public function store(LectureRequest $request)
    {

        $user = auth()->user();
        $lecture = new Lecture();

        $lecture->name = $request->input('name');
        $lecture->description = $request->input('description');
        $lecture->module_id = $request->input('module_id');
        $lecture->date = $request->input('lecture_date');
        $lecture->save();

        if ($user && $user->user_type == UserType::ADMIN_CODE) {
            return redirect()->route('lecture.index')->with('success', 'Lecture created successfully.');
        } elseif ($user && $user->user_type == UserType::TEACHER_CODE) {
            return redirect()->route('teacher_rolepanel')->with('success', 'Lecture created successfully.');
        } else {
            return redirect()->route('lecture.index')->with('success', 'Lecture created successfully.');
        }

    }

    public function show(Lecture $lecture)
    {
        return view('lecture.show', compact('lecture'));
    }

    public function edit(Lecture $lecture)
    {
        return view('lecture.edit', ['lecture' => $lecture]);
    }

    public function update(LectureRequest $request, Lecture $lecture)
    {
        $lecture->name = $request->input('name');
        $lecture->description = $request->input('description');
        $lecture->module_id = $request->input('module_id');
        $lecture->date = $request->input('lecture_date');
        $lecture->save();

        return redirect()->route('lecture.index')->with('success', 'Lecture updated successfully.');
    }

    public function destroy(Lecture $lecture)
    {
        Grade::where('lecture_id', $lecture->id)->delete();
        HomeworkTask::where('lecture_id', $lecture->id)->each(function ($task) {
            $task->delete();
        });

        $lecture->delete();
        
        return redirect()->route('lecture.index')->with('success', 'Lecture deleted successfully.');
    }
}
