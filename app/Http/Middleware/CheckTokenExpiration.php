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
       


        if (Auth::check()) {
            $user = Auth::user();

            
            $latestToken = $user->tokens()->latest()->first();

            if ($latestToken && $latestToken->expires_at < now()) {
                
                $latestToken->delete();

               
                Auth::guard('web')->logout();

                return redirect('/login')->with('error', 'Your session has expired. Please log in again.');
            }
        }

        return $next($request);
    


        
    }


    
    

    
}
