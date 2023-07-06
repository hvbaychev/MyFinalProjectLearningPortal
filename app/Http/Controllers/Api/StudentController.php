<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbstractBaseController;
use App\Models\User;


class StudentController extends AbstractBaseController
{
    public function index()
    {
        $users = User::where('user_type', 'student')->orderBy('id')->get();
        return response()->json(compact('users'));
    }

    public function show(User $user)
    {

        return response()->json(['user' => $user]);
    }
}


