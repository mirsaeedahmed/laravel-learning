<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$role)
    {
        //dd($request->user());
        //dd(Auth::check());
        if (!$request->user() || !$request->user()->hasRole($role)) {
            // Abort or return a custom response
            return response('Unauthorized.', 401);
        }
        return $next($request);
        /*dd($role);
        if (!Auth::check()) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        $user = Auth::user();

        // Assuming your User model has a method `hasRole`
        if (!$user->hasRole($role)) {
            // Forbidden response if user doesn't have the role
            return response()->json(['message' => 'Unauthorized, insufficient role'], 403);
        }

        return $next($request);*/
    }
}
