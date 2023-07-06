<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractBaseController;
use App\Http\Requests\HomeworkRequest;
use App\Models\HomeworkTask;
use App\Models\UserHomeworkTask;
use App\Models\Lecture;
use Illuminate\Support\Facades\File;
use App\Models\UserType;
use App\Http\Requests\UserHomeworkFileUpoloadRequest;
use App\Models\Grade;

class HomeworkController extends AbstractBaseController
{
    public function index()
    {

        $user = auth()->user();

        if ($user && $user->user_type == UserType::STUDENT_CODE) {

            $userId = $user->id;
            $homeworks = HomeworkTask::whereHas('lecture.module.course.users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })->get();

        } else {

            $homeworks = HomeworkTask::orderBy('id')->get();
        }


        return view('homework.index', compact('homeworks'));

    }



    public function create()
    {
        $lectures = Lecture::all();
        return view('homework.create', compact('lectures'));
    }



    public function store(HomeworkRequest $request)
    {

        $homework = new HomeworkTask();
        $homework->name = $request->input('name');
        $homework->description = $request->input('description');
        $homework->lecture_id = $request->input('lecture_id');

        $FilePath = config('app.files_path').'homework/';
        if ( $homework->file != null ){
            File::delete($FilePath . $homework->file);
        }

        $homework->file = time() . '.' . $request->file('file')->extension();
        $result = $request->file->move($FilePath , $homework->file);
        $homework->save();

        return redirect()->route('homework.index')->with('success', 'Homework created successfully.');
    }

    public function show(HomeworkTask $homework)
    {
        $user = auth()->user();
        $user_homework_task = UserHomeworkTask::where('homework_task_id', $homework->id)->first();

        if(!$user_homework_task) {
            $user_homework_task = null;
        } 
        return view('homework.show', compact('homework', 'user', 'user_homework_task'));
    }

    public function edit(HomeworkTask $homework)
    {
        $lectures = Lecture::all();

        return view('homework.edit', compact('homework', 'lectures'));
    }


    public function update(HomeworkRequest $request, HomeworkTask $homework)

    {
        $FilePath = config('app.files_path').'homework/';
        
        if ($request->input('name') != $homework->name){
            $homework->name = $request->input('name');
        }
        
        if ($request->input('description') != $homework->description){
            $homework->description = $request->input('description');
        }
        
        if($homework->lecture_id != $request->input('lecture_id')){
            $homework->lecture_id = $request->input('lecture_id');
        }
        
        
        if ( $request->file('file') ){
            $file_name = time() . '.' . $request->file('file')->extension();
            if ( $homework->file != null ){
                File::delete($FilePath . $homework->file);
            }
            $request->file('file')->move($FilePath , $file_name);
            $homework->file = $file_name;
        }


        $homework->save();

        return redirect()->route('homework.index')->with('success', 'Homework updated successfully.');
    }



    public function destroy(HomeworkTask $homework)
    {
        if ($homework->userHomeworkTasks()->exists()) {
            $homework->userHomeworkTasks()->delete();
        }

        $homework->delete();

        return redirect()->route('homework.index')->with('success', 'Homework deleted successfully.');
    }


    public function upload_homework_file(HomeworkTask $homework, UserHomeworkFileUpoloadRequest $request) {
        
        $FilePath = config('app.files_path').'homework/';
        $user = auth()->user();
        $file_name = time() . '.' . $request->file('file')->extension();

        $user_homework_task = UserHomeworkTask::where('homework_task_id', $homework->id)
            ->where('user_id', $user->id)
            ->first();

        if(!$request->file('file')) {

            return view('homework.show', compact('homework'))->with('fail', 'Something went wrong. Upload again!');
        
        } else {

            if ( !$user_homework_task ) {
                $user_homework_task = new UserHomeworkTask();
                $user_homework_task->homework_task_id = $homework->id;
                $user_homework_task->student_homework = $file_name;
                $user_homework_task->user_id = $user->id;
    
            } else {
    
                if ( $user_homework_task->student_homework != NULL ) {
                    File::delete($FilePath . $file_name);
                }
                $user_homework_task->student_homework = $file_name;
            }
    
            $result = $request->file->move($FilePath, $file_name);
    
            if ( !$result ) {
                return view('homework.show', compact('homework', 'user', 'user_homework_task'))->with('fail', 'Something went wrong. Upload again!');
            }
    
            $user_homework_task->save();
    
            $grade = Grade::where('user_homework_task_id', $user_homework_task->id)->first();
            
            if(!$grade) {
                $homeworkForReview = new Grade();
                $homeworkForReview->user_id = $user->id;
                $homeworkForReview->user_homework_task_id = $user_homework_task->id;
                $homeworkForReview->lecture_id = $homework->lecture->id;
                $homeworkForReview->save();
            }
    
            return view('homework.show', compact('homework', 'user', 'user_homework_task'))->with('success', 'Your homework has been uploaded!');
        }
    }
}
