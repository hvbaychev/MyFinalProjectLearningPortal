<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\AbstractBaseController;
use App\Http\Requests\GradeRequest;
use App\Models\Absence;
use App\Models\CourseModule;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\UserHomeworkTask;
use App\Models\Course;
use App\Models\HomeworkTask;
use App\Models\UserType;

class GradeController extends AbstractBaseController
{
    public function index()
    {

        $user = auth()->user();
        if($user && $user->user_type == UserType::BUSINESS_CODE) {

            $users = User::where('user_type', 'business')->first();

            $courses = Course::whereHas('users', function ($query) use ($users) {
                $query->where('user_id', $users->id);
            })->get();

            
            $students = User::where('user_type', 'student')->whereHas('courses.users', function ($query) {
                $query->where('user_type', 'business');
            })->get();

        } elseif($user && $user->user_type == UserType::STUDENT_CODE) {

            $courses = $user->courses()->wherePivotIn('status', ['approved', 'waiting'])->distinct()->get();
            $students = auth()->user();

        } else {

            $courses = Course::all();
            $students = User::where('user_type', 'student')->get();

        }



        return view('grade.index', compact('courses', 'students')); 
    }

    public function create()
    {

        return view('grade.create');
    }

    public function store(GradeRequest $request)
    {
        $grade = new Grade();
        $grade->user_id = $request->input('user_id');
        $grade->course_id = $request->input('course_id');
        $grade->grade = $request->input('grade');
        $grade->save();

        return redirect()->route('grade.index')->with('success', 'Grade created successfully.');
    }

    public function show(Grade $grade)
    {
        return view('grade.show', compact('grade'));
    }

    public function edit(Grade $grade)
    {
        return view('grade.edit', compact('grade'));
    }

    public function update(GradeRequest $request, Grade $grade)
    {
        $grade->user_id = $request->input('user_id');
        $grade->course_id = $request->input('course_id');
        $grade->grade = $request->input('grade');
        $grade->save();

        return redirect()->route('grade.index')->with('success', 'Grade updated successfully.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grade.index')->with('success', 'Grade deleted successfully.');
    }





    public function modules(int $courseId)
    {
        $modules = CourseModule::where('course_id', $courseId)->get();

        return response()->json($modules);
    }

    public function lectures(int $moduleId)
    {
        $lectures = Lecture::where('module_id', $moduleId)->get();

        return response()->json($lectures);
    }

    public function grades(int $studentId, int $moduleId)
    {
        $grades = Grade::where('user_id', $studentId)->get();
        $userHomeworkTasks = UserHomeworkTask::where('user_id', $studentId)->get();

        $lectureIds = [];
        foreach ($userHomeworkTasks as $userHomeworkTask) {
            if ($userHomeworkTask->homeworkTask->lecture->module_id === $moduleId) {
                $lectureIds[] = $userHomeworkTask->homeworkTask->lecture_id;
            }
        }

        return response()->json(['grades' => $grades, 'lectureIds' => array_unique($lectureIds)]);
    }

    public function getDate(int $lectureId)
    {
        $lecture = Lecture::find($lectureId);
        if ($lecture) {
            return response()->json($lecture->date);
        }
        return response()->json('Lecture not found', 404);
    }

    public function saveAbsence(Request $request)
    {
        $lecture_id = $request->input('lectureId');
        $studentId = $request->input('studentId');
        $absenceOption = $request->input('absenceOption');
        $disregarded = $request->input('disregarded');
        $note = $request->input('note');

        $absence = new Absence();
        $absence->lecture_id = $lecture_id;
        $absence->user_id = $studentId;
        $absence->reason = $absenceOption;
        $absence->disregarded = $disregarded;
        $absence->note = $note;
        $absence->save();


        return response()->json(['success' => true]);
    }

    public function getHomeworkByStudentId($studentId)
    {
        $homework = UserHomeworkTask::where('user_id', $studentId)->get();
        return response()->json($homework);
    }

     public function getStudentResults($studentId)
    {


        $grades = Grade::where('user_id', $studentId)->get();
        $gradeArr = [];

        foreach ($grades as $grade) {
            if ($grade->userHomeworkTask != null) {
                $gradeArr[] =  [
                    'gradeId' => $grade->id,
                    'name' => $grade->userHomeworkTask->homeworkTask->name,
                    'userHomeworkTask' => $grade->userHomeworkTask->id,
                    'type' => 'homework',
                    'grade' => $grade->grade,
                    'isWorking' => $grade->userHomeworkTask->is_working,
                    'onTime' => $grade->userHomeworkTask->on_time,
                ];
            } else {
                $gradeArr[] = [
                    'gradeId' => $grade->id,
                    'name' => $grade->lecture->name,
                    'type' => 'lecture',
                    'grade' => $grade->grade
                ];
            }
        }

        return response()->json($gradeArr);
    }


    public function saveGrades(Request $request)
    {
        $requestAllGrades = $request->input('requestAllGrades');
        $requestAllWorking = $request->input("requestAllWorking");
        $requestAllOnTime = $request->input("requestAllOnTime");

        foreach ($requestAllGrades as $newGrade) {
            $grade = Grade::find($newGrade['grade_id']);

            if ($grade->grade != $newGrade['grade']) {
                $grade->grade = $newGrade['grade'];
                $grade->save();
            }
        }

        foreach ($requestAllWorking as $newWorking) {
            $userHomework = UserHomeworkTask::find($newWorking['userHomework_id']);

            $isWorking = filter_var($newWorking['is_working'], FILTER_VALIDATE_BOOLEAN);

            if ($userHomework && $userHomework->is_working !== $isWorking) {
                $userHomework->is_working = $isWorking;
                $userHomework->save();
            }
        }

        foreach ($requestAllOnTime as $newOnTime) {
            $userHomework = UserHomeworkTask::find($newOnTime['userHomework_id']);

            $isOnTime = filter_var($newOnTime['on_time'], FILTER_VALIDATE_BOOLEAN);

            if ($userHomework && $userHomework->on_time != $isOnTime) {
                $userHomework->on_time = $isOnTime;
                $userHomework->save();
            }
        }

        return response()->json(['message' => 'Grades saved successfully']);
    }


    public function getStudents(int $lectureId) {

        $lecture = Lecture::with('module.course')->find($lectureId);
        $course = $lecture->module->course;
        $students = $course->users()->where('user_type', 'student')->get()->unique();

        return response()->json($students);
    }
}
