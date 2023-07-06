<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use App\Models\Password_reset;
use Illuminate\Support\Facades\App;
use Illuminate\Http\JsonResponse;
use App\Events\SendMail;


class AuthController extends Controller
{

    public function login()
    {
        $courses = $this->coursesList();
        return response()->json(['courses' => $courses]);
    }

    public function any()
    {
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');
        $timeStamp = Carbon::now()->timestamp;
        $language = App::getLocale();

        $message = [
            'message' => trans('message.welcome_message', $language),
            'DataTime' => $currentDateTime,
            'timezone' => app('timezone'),
            'timestamp' => $timeStamp,
        ];

        return response()->json($message);
    }


    public function login_post(LoginRequest $request)
    {

        $credentials = $request->getCredentials();

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Wrong Email or Password'], 401);
        }

        $email = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($email);
        return $this->authenticated($request, $email);
    }


    /**
     * Show the registration form
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register()
    {
        $courses = $this->coursesList();
        return response()->json(['courses' => $courses]);
    }

    /**
     * Register a new user
     *
     * @bodyParam first_name string required The first name of the user.
     * @bodyParam last_name string required The last name of the user.
     * @bodyParam email string required The email of the user.
     * @bodyParam password string required The password of the user.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function registerUser(RegisterRequest $request)
    {
        if ($request->validated()) {
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['message' => 'You have registered successfully. Check your email!'], 201);
        } else {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }



    /**
     * Handle the authenticated request
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        if (Auth::check()) {
            return response()->json(['message' => 'Authentication successful']);
        }
        return response()->json(['error' => 'Authentication failed'], 401);
    }



    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        $token = Str::random(100);
        $expires = Config::get('auth.passwords.users.expire');
        $expires_at = now()->addMinutes($expires);

        if (!$user) {
            return new JsonResponse([
                'message' => 'Invalid email',
            ], 404);
        } else {
            $passReset = new Password_reset();
            $passReset->email = $request->email;
            $passReset->token = $token;
            $passReset->expires_at = $expires_at;
            $passReset->save();
        }

        SendMail::dispatch($user, 'reset_password', $expires);

        return new JsonResponse([
            'message' => 'Email sent! Check your inbox.',
        ], 200);
    }



    public function resetPassword($token)
    {
        $resetData = Password_reset::where('token', $token)->first();

        if (!$resetData) {
            return new JsonResponse([
                'message' => 'Invalid token!',
            ], 404);
        }

        $expiresAt = Carbon::parse($resetData->expires_at);

        if (Carbon::now()->isAfter($expiresAt)) {
            return new JsonResponse([
                'message' => 'Reset token has expired!',
            ], 400);
        }

        return new JsonResponse([
            'token' => $token,
        ], 200);
    }



    /**
     * Logout the user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message' => 'You have been logged out. See you soon!'
        ]);
    }
}
