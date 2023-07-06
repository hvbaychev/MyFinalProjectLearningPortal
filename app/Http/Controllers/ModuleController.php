<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\AbstractBaseController;
use App\Http\Requests\ModuleRequest;
use App\Models\CourseModule;
use App\Models\Grade;
use App\Models\HomeworkTask;
use App\Models\UserType;

class ModuleController extends AbstractBaseController
{
    public function index()
    {

        $user = auth()->user();


        if($user && $user->user_type == UserType::BUSINESS_CODE) {

            $courses = $user->courses()
            ->wherePivot('status', 'business')
            ->get();


            $modules = collect();
            foreach ($courses as $course) {
                $modules = $modules->merge($course->courseModules);
            }

        } elseif($user && $user->user_type == UserType::STUDENT_CODE) {
            
            $courses = $user->courses()->wherePivotIn('status', ['approved', 'waiting'])->get();

            $modules = collect();
            foreach ($courses as $course) {
                $modules = $modules->merge($course->courseModules);
            }

        } else {

            $modules = CourseModule::orderBy('id')->get();
        }

        return view('module.index', compact('modules'));
    }

    public function create()
    {
        return view('module.create');
    }

    public function store(ModuleRequest $request)
    {
        $module = new CourseModule();
        $module->course_id = $request->input('course_id');
        $module->name = $request->input('name');
        $module->description = $request->input('description');
        $module->save();

        $user = auth()->user();

        if (($user && $user->user_type === 'admin') || ($user && $user->user_type === 'teacher')) {
            return redirect()->route('module.index')->with('success', 'Lecture created successfully.');
        }

        return redirect()->route('module.index')->with('success', 'Lecture created successfully.');

    }

    public function show(CourseModule $module)
    {

        return view('module.show', compact('module'));
    }

    public function edit(CourseModule $module) {
        return view('module.edit', ['module' => $module]);
    }


    public function update(CourseModule $module, ModuleRequest $request)
    {
        $module->course_id = $request->input('course_id');
        $module->name = $request->input('name');
        $module->description = $request->input('description');
        $module->save();

        return redirect()->route('module.index')->with('success', 'Module updated successfully.');
    }

    public function destroy(CourseModule $module)
    {
        $module->lectures->each(function ($lecture) {
            Grade::where('lecture_id', $lecture->id)->delete();

            HomeworkTask::where('lecture_id', $lecture->id)->each(function ($task) {
                $task->userHomeworkTasks()->delete();
                $task->delete();
            });

            $lecture->delete();
        });

        $module->delete();

        return redirect()->route('module.index')->with('success', 'Module deleted successfully.');
    }
}
