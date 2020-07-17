<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role="")
    {

        $user = $request->user();
        $checkRole = 0;

        if($user->role == $role){
            $checkRole = 1;
        };

        if($checkRole == 1){
            return $next($request);
        }else{
            return abort(401);
        }


    }
}
