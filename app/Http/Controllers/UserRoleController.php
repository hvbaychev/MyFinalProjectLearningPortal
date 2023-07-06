<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractBaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MenuItem;

class UserRoleController extends AbstractBaseController
{
    public function index() {
        return view('home');
    }

    public function rolePanel() {

        $user = Auth::user();
        $roles = ['admin', 'student', 'teacher', 'business'];


        if (in_array($user->user_type, $roles)) {
            switch ($user->user_type) {
                case 'admin':
                    return view('profiles.adminFiles.admin');
                    break;
                case 'student':
                    return view('profiles.studentFiles.student');
                    break;
                case 'teacher':
                    return view('profiles.teacherFiles.teacher');
                    break;
                case 'business':
                    return view('profiles.businessFiles.business');
                    break;
            }
        }

        abort(403, 'Unauthorized');
    }

   
}
