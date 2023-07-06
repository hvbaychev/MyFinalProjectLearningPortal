<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if ($user && in_array($user->user_type, $roles)) {
            return $next($request);
        }

        return Redirect::to('home')->with('fail', '403 - YOU ARE TRYING TO ACCESS AN UNAUTHORIZED RESOURCE!');
    }

}
