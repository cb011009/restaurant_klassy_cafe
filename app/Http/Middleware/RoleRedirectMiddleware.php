<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    

     public function handle($request, Closure $next, ...$roles)
     {
         $user = auth()->user();
 
         if ($user && in_array($user->user_role, $roles)) {
             return $next($request);
         }
 
         
         return redirect('/login'); 
     }
}
