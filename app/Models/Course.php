<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'description', 'logo', 'start_date', 'end_date', 'duration', 'file'];

    public function courseModules()
    {
        return $this->hasMany(CourseModule::class, 'course_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_courses')->withPivot('id', 'status')->withTimestamps();
    }
}
