<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractBaseController;
use App\Http\Requests\HomeworkRequest;
use App\Models\HomeworkTask;
use App\Models\UserHomeworkTask;
use App\Models\Lecture;
use Illuminate\Support\Facades\File;

class HomeworkController extends AbstractBaseController
{
    public function index()
    {
        if (auth()->user() && auth()->user()->user_type == 'student') {
            $homeworks = UserHomeworkTask::whereHas('user', function ($query) {
                $query->where('user_type', 'student');
            })->with('homeworkTask')->get()->pluck('homeworkTask')->unique();
        } else {
            $homeworks = HomeworkTask::orderBy('id')->get();
        }

        $lectures = Lecture::all();

        return response()->json([
            'homeworks' => $homeworks,
            'lectures' => $lectures
        ]);
    }

    public function create()
    {
        $lectures = Lecture::all();
        return response()->json([
            'lectures' => $lectures
        ]);
    }

    public function store(HomeworkRequest $request)
    {
        $homework = new HomeworkTask();
        $homework->name = $request->input('name');
        $homework->description = $request->input('description');
        $homework->lecture_id = $request->input('lecture_id');


        $homework->save();

        return response()->json(['message' => 'Homework created successfully']);
    }

    public function show(HomeworkTask $homework)
    {
        return response()->json(['homework' => $homework]);
    }

    public function edit(HomeworkTask $homework)
    {
        $lectures = Lecture::all();
        return response()->json([
            'homework' => $homework,
            'lectures' => $lectures
        ]);
    }

    public function update(HomeworkRequest $request, HomeworkTask $homework)
    {

        if ($request->input('name') != $homework->name) {
            $homework->name = $request->input('name');
        }
        if ($request->input('description') != $homework->description) {
            $homework->description = $request->input('description');
        }
        if ($homework->lecture_id != $request->input('lecture_id')) {
            $homework->lecture_id = $request->input('lecture_id');
        }

        $homework->save();

        return response()->json(['message' => 'Homework updated successfully']);
    }

    public function destroy(HomeworkTask $homework)
    {
        $homework->delete();
        return response()->json(['message' => 'Homework deleted successfully']);
    }
}
