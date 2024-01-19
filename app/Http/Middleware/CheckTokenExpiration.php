<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckTokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    

     public function handle($request, Closure $next)
    {
        /*
        $user = Auth::user();

        // Check if the user has a valid token
        if ($user && $user->tokens()->latest()->first() && $user->tokens()->latest()->first()->expires_at < now()) {
            // Token has expired, revoke it and log the user out
            $user->tokens()->latest()->first()->revoke();
            Auth::logout();

            return redirect('/login')->with('error', 'Your session has expired. Please log in again.');
        }

        return $next($request);*/


        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user has a valid token
            $latestToken = $user->tokens()->latest()->first();

            if ($latestToken && $latestToken->expires_at < now()) {
                // Token has expired, delete it
                $latestToken->delete();

                // Log the user out
                Auth::guard('web')->logout();

                return redirect('/login')->with('error', 'Your session has expired. Please log in again.');
            }
        }

        return $next($request);
    


        
    }

    
}
