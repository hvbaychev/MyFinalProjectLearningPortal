<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\NewPasswordRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Password_reset;
use App\Events\SendMail;



class AuthController extends AbstractBaseController
{
    public function login()
    {
        return view('auth.login');
    }



    public function login_post(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!Auth::attempt($credentials)) {
            return back()->with('fail', 'Wrong Email or Password');
        }
        $user= Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);
        return $this->authenticated($request, $user);
    }

    public function register()
    {
        return view('auth.register');
    }


    public function registerUser(RegisterRequest $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);


        if ($user->save()) {

            SendMail::dispatch($user, 'registration', null);

            return redirect()->route('login')->with('success', 'You have registered successfully. Check your email!');
        } else {
            return back()->with('fail', 'Something went wrong. Try again!');
        }
    }



    protected function authenticated(Request $request, $email)
    {

        if (Auth::check()) {
            return redirect()->route('home');
        }
        return redirect('/login');
    }

    public function index()
    {
        return view('auth.password_res.forgot_pass');
    }


    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        $token = Str::random(100);
        $expires = Config::get('auth.passwords.users.expire');
        $expires_at = now()->addMinutes($expires);

        if (!$user) {
            return redirect()->route('forgot_password')->with('fail', 'Invalid email');
        } else {
            $passReset = new Password_reset();
            $passReset->email = $request->email;
            $passReset->token = $token;
            $passReset->expires_at = $expires_at;
            $passReset->save();
        }


        SendMail::dispatch($user, 'reset_password', $expires);

        return redirect()->route('forgot_password')->with('success', 'Email sent! Check your inbox.');
    }


    public function resetPassword($token)
    {
        $resetData = Password_reset::where('token', $token)->first();

        if (!$resetData) {
            return redirect()->route('forgot_password')->with('fail', 'Invalid token!');
        }

        $expiresAt = Carbon::parse($resetData->expires_at);

        if (Carbon::now()->isAfter($expiresAt)) {
            return redirect()->route('forgot_password')->with('fail', 'Reset token has expired!');
        }

        return view('auth.password_res.new_password', ['token' => $token]);
    }


    public function resetPasswordPost(NewPasswordRequest $request)
    {
        $newPass = Password_reset::where('token', $request->token)->first();

        if (!$newPass) {
            return redirect()->route('reset_password', ['token' => $request->token])->with('fail', 'Not valid credentials!');
        }

        $user = User::where('email', $newPass->email)->first();

        if (!$user) {
            return redirect()->route('reset_password', ['token' => $request->token])->with('fail', 'User not found!');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $newPass->delete();

        SendMail::dispatch($user, 'reset_password_confirmation', null);

        return redirect()->route('show_form')->with('success', 'Your password has been reset! Check your email!');
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect()->route('show_form')->with('success', 'You have been logged out. See you soon!');
    }
}
