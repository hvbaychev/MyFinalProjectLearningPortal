<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AbstractBaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends AbstractBaseController
{
    public function index()
    {
        return response()->json(['message' => 'Welcome to the API']);
    }

    public function rolePanel()
    {
        $user = Auth::user();
        $roles = ['admin', 'student', 'teacher', 'business'];

        if (in_array($user->user_type, $roles)) {
            switch ($user->user_type) {
                case 'admin':
                    return response()->json(['message' => 'Admin panel']);
                    break;
                case 'student':
                    return response()->json(['message' => 'Student panel']);
                    break;
                case 'teacher':
                    return response()->json(['message' => 'Teacher panel']);
                    break;
                case 'business':
                    return response()->json(['message' => 'Business panel']);
                    break;
            }
        }
        abort(403, 'Unauthorized');
    }
}
