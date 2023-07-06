<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeworkTask extends Model
{
    protected $fillable = ['lecture_id', 'name', 'description', 'file'];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function userHomeworkTasks()
    {
        return $this->hasMany(UserHomeworkTask::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

