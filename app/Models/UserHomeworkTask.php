<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHomeworkTask extends Model
{
    protected $fillable = ['homework_task_id', 'user_id', 'description', 'file', 'on_time', 'is_working'];

    public function homeworkTask()
    {
        return $this->belongsTo(HomeworkTask::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
