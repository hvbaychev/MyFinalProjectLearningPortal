<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class CourseModule extends Model
{
    protected $fillable = ['course_id', 'name', 'description'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'module_id');
    }
}
