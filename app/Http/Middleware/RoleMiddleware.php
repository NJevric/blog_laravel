<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $userRole = $request->user()->roles;
        $userRole = auth()->user()->roles;
        // dd($userRole->count());
        if($userRole->count() == 1){
            foreach($userRole as $role){
      
                if($role->name == 'User'){
                    abort(403, 'You are not authorized');
                }
             
            } 
        }
        
        return $next($request);
    }
}
