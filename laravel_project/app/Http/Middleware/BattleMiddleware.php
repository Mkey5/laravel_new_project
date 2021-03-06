<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BattleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = null)
    {   
        $currentUser = Auth::user();
        
        $battleInProgress = $currentUser->battles
        ->where('battle_time','!=' , '0001-01-01 00:00:00')
        ->where('attacker', '=' , $currentUser->id)
        ->first() ? true : false;

        if (Auth::guard($guard)->check() && $battleInProgress == true && $currentUser->fleet->state == 'ready') {
            return $next($request);
        }

        return redirect('/home');
    }
}
