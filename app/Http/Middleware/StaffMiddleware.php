<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //--Staf, Supervisor, Administrator, dan Webmaster boleh mengelola data desa.
        if (auth()->user() && in_array((int) auth()->user()->role_id, [1, 2, 88, 99], true)) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Anda tidak memiliki akses ke area pengelolaan data.');
    }
}
