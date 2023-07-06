<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\AbstractBaseController;
use App\Http\Requests\ModuleRequest;
use App\Models\CourseModule;
use App\Models\Grade;
use App\Models\HomeworkTask;

class ModuleController extends AbstractBaseController
{
    public function index()
    {
        $modules = CourseModule::orderBy('id')->get();
        return response()->json(compact('modules'));
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

           return response()->json(['success' => 'Module created successfully.']);
    }

    public function show(CourseModule $module)
    {
        return response()->json(compact('module'));
    }

    public function edit(CourseModule $module)
    {
        return response()->json(compact('module'));
    }

    public function update(ModuleRequest $request, CourseModule $module)
    {
        $module->course_id = $request->input('course_id');
        $module->name = $request->input('name');
        $module->description = $request->input('description');
        $module->save();

        return response()->json(['success' => 'Module updated successfully.']);
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

        return response()->json(['success' => 'Module deleted successfully.']);
    }
}
