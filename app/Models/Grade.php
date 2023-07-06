<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['user_id', 'user_homework_task_id', 'lecture_id', 'grade'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userHomeworkTask()
    {
        return $this->belongsTo(UserHomeworkTask::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }


}
