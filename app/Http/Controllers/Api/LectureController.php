<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\AbstractBaseController;
use App\Http\Requests\LectureRequest;
use App\Models\Lecture;
use App\Models\Grade;
use App\Models\HomeworkTask;
use App\Models\CourseModule;

class LectureController extends AbstractBaseController
{
    public function index()
    {
        $lectures = Lecture::orderBy('id')->get();
        return response()->json(compact('lectures'));
    }

    public function create()
    {
        $modules = CourseModule::all();
        return response()->json(['modules' => $modules]);
    }

    public function store(LectureRequest $request)
    {
        $lecture = new Lecture();

        $lecture->name = $request->input('name');
        $lecture->description = $request->input('description');
        $lecture->module_id = $request->input('module_id');
        $lecture->date = $request->input('lecture_date');
        $lecture->save();


        return response()->json(['message' => 'Lecture created successfully']);

    }

    public function show(Lecture $lecture)
    {
        return response()->json(compact('lecture'));
    }

    public function edit(Lecture $lecture)
    {
        return response()->json(['lecture' => $lecture]);
    }

    public function update(LectureRequest $request, Lecture $lecture)
    {
        $lecture->name = $request->input('name');
        $lecture->description = $request->input('description');
        $lecture->module_id = $request->input('module_id');
        $lecture->date = $request->input('lecture_date');
        $lecture->save();

        return response()->json(['message' => 'Lecture updated successfully']);
    }

    public function destroy(Lecture $lecture)
    {
        Grade::where('lecture_id', $lecture->id)->delete();
        HomeworkTask::where('lecture_id', $lecture->id)->each(function ($task) {
            $task->delete();
        });

        $lecture->delete();

        return response()->json(['message' => 'Lecture deleted successfully']);
    }
}
