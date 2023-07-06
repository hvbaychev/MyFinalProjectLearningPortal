<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\AbstractBaseController;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Models\UserType;
use ReflectionClass;
use Illuminate\Support\Facades\Hash;



class UserController extends AbstractBaseController
{



    public function index()
    {
        try {
            $users = User::orderBy('id')->get();
            return response()->json(compact('users'));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {

        return response()->json([
            'first_name' => 'input your first name',
            'last_name' => 'input your last name',
            'email' => 'input your email',
            'user_type' => 'user type',
            'password' => 'password minimum 5 char',
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            if (!$request->wantsJson()) {
                return response()->json([
                    'message' => 'Error',
                    'error' => 'Invalid request format. JSON format is required.',
                ], 400);
            }

            $validatedData = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'user_type' => 'required',
                'password' => 'required|min:5',
            ]);

            $user = new User();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->user_type = $request->input('user_type');
            $user->password = Hash::make($request->input('password'));


            $user->save();

            return response()->json([
                'message' => 'Success',
                'data' => 'User created successfully.'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors()
            ], 422);
        }
    }


    public function show(Request $request, $id)
    {
        try {
            if (!is_numeric($id)) {
                throw new \Exception('Invalid ID');
            }

            $user = User::findOrFail($id);
            return response()->json(compact('user'));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function edit()
    {
        return response()->json([
            'first_name' => 'input your first name',
            'last_name' => 'input your last name',
            'email' => 'input your email',
            'user_type' => 'user type',
            'password' => 'password minimum 5 char',
        ], 200);
    }

    public function update(Request $request, User $user)
    {
        try {
            if (!$request->wantsJson()) {
                return response()->json([
                    'message' => 'Error',
                    'error' => 'Invalid request format. JSON format is required.',
                ], 400);
            }

            $validUserTypes = array_values((new ReflectionClass(UserType::class))->getConstants());
            $validUserTypes = array_diff($validUserTypes, ['created_at', 'updated_at']);

            if ($request->has('first_name')) {
                $user->first_name = $request->input('first_name');
            }

            if ($request->has('last_name')) {
                $user->last_name = $request->input('last_name');
            }

            if ($request->has('email')) {
                $user->email = $request->input('email');
            }

            if ($request->has('user_type') && in_array($request->input('user_type'), $validUserTypes)) {
                $user->user_type = $request->input('user_type');
            } else {
                return response()->json([
                    'message' => 'Error',
                    'error' => 'Wrong user type',
                ], 500);
            }

            if ($request->has('password')) {
                $user->password = $request->input('password');
            }

            $user->save();

            return response()->json(['success' => 'User updated successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(['success' => 'User deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
