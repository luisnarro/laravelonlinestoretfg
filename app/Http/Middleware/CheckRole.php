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
    public function handle($request, Closure $next)
    {
        if ($request->user() === null)
        {
            //return response("No tiene permisos suficientes para estar aquí.", 401);
            //return view('errors/not_authorized', []);
            return redirect()->back();
        }
        
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;
        
        if ($request->user()->hasAnyRole($roles) || !$roles){
            return $next($request);
        }
        //return response("No tiene permisos suficientes para estar aquí.", 401);
        //return view('errors/not_authorized', []);
        return redirect()->back();
    }
}
