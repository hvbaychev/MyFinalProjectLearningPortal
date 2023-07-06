<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = ['module_id', 'name', 'description', 'date', 'file'];

    public function module()
    {
        return $this->belongsTo(CourseModule::class, 'module_id');
    }

    public function homeworkTasks()
    {
        return $this->hasMany(HomeworkTask::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class);
}

public function course()
{
    return $this->belongsTo(Course::class);
}
}

