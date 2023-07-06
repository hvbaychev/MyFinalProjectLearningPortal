<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\UserHomeworkTask;
use App\Models\Lecture;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{
    public function index()
    {
        if (auth()->user() && auth()->user()->user_type == 'student') {
            $courseIds = UserHomeworkTask::whereHas('user', function ($query) {
                $query->where('user_type', 'student');
            })->with('homeworkTask.lecture.module')->get()->pluck('homeworkTask.lecture.module.course_id')->unique();
            $courses = Course::whereIn('id', $courseIds)->get();
        } else {
            $courses = Course::orderBy('id')->get();
        }

        return response()->json($courses);
    }

    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function store(CourseRequest $request)
    {
        $course = new Course();
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->duration = $request->input('duration');
        $course->start_date = $request->input('start_date');
        $course->end_date = $request->input('end_date');

        if ($request->hasFile('file')) {
            $filePath = config('app.files_path') . '/course/file/';
            $course->file = $request->file('file');
            $fileName = time() . '.' . $course->file->extension();
            $request->file('file')->move($filePath, $fileName);
            $course->file = $fileName;
        }

        $course->save();

        return response()->json(['message' => 'Course created successfully']);
    }

    public function show(Course $course)
    {
        $status = null;
        $courseId = $course->id;
        $user = Auth::user();
        if ($user) {
            if ($user->courses->contains($courseId)) {
                $student = $user->courses->find($courseId);
                $status = $student->pivot->status;
                if ($status !== 'approved' && $status !== 'waiting') {
                    $status = null;
                }
            }
        }

        $students = $course->users;
        $lectures = $course->courseModules()->with('lectures')->get()->pluck('lectures')->flatten();

        return response()->json([
            'status' => $status,
            'course' => $course,
            'students' => $students,
            'lectures' => $lectures
        ]);
    }

    public function getLectures(Course $course)
    {
        $lectures = Lecture::whereHas('module.course', function ($query) use ($course) {
            $query->where('id', $course->id);
        })->get();

        return response()->json($lectures);
    }

    public function edit(Course $course)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function updateCourse(CourseRequest $request, $id)
    {
        $course = Course::find($id);
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->duration = $request->input('duration');
        $course->start_date = $request->input('start_date');
        $course->end_date = $request->input('end_date');

        $course->save();

        return response()->json(['message' => 'Course updated successfully']);
    }



    public function destroy(Course $course)
    {
        $course->courseModules()->delete();
        $course->delete();

        return response()->json(['message' => 'Course deleted successfully']);
    }
}
