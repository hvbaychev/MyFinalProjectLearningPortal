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

class GradeController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $students = User::where('user_type', 'student')->get();

        return response()->json([
            'courses' => $courses,
            'students' => $students,
        ]);

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
}


