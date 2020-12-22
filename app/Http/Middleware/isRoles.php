<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            if (Auth::user()->role == $role && Auth::user()->status == 1) {
                if (Auth::user()->role == 2 && Auth::user()->murid->kelas_id == 0) {
                    abort(403);
                } elseif (Auth::user()->is_guru && count(Auth::user()->mengajar) <= 0) {
                    abort(403);
                }
                return $next($request);
            }
        }
        abort(403);
    }
}
