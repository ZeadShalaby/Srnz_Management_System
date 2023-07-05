<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        $role = auth()->user();
        if(!$role){
           $role = 0 ;
        }
        else{$role = auth()->user()->role;}
        if ( $role!== Role::ADMIN) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
