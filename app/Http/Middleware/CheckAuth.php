<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;

class CheckAuth
{
    public function handle(Request $request, Closure $next)
    {
        $role = auth()->user();
        if(!$role){
           $role = 0 ;
           abort(403, 'Unauthorized');

        }
        else{$role = auth()->user()->role;}
        if ( ($role == Role::ADMIN)||($role == Role::CUSTOMER)) {
            return $next($request);

        }
    
        abort(403, 'Unauthorized');
    
}}
