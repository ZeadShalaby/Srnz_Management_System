<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCustomerRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $role = auth()->user();
        if(!$role){
           $role = 0 ;
        }
        else{$role = auth()->user()->role;}
        if ( $role!= Role::CUSTOMER) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
