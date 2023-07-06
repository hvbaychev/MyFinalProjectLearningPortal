<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{

    const ADMIN_CODE = 'admin';
    const STUDENT_CODE = 'student';
    const TEACHER_CODE = 'teacher';
    const BUSINESS_CODE = 'business';
    const PUBLIC_CODE = 'public';

}
