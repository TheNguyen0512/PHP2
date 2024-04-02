<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerPageAccess
{
    public function handle($request, Closure $next,$role)
    {
        if (Auth::check()) {
            foreach (Auth::user()->roles as $item) {
                if($item['rol_name'] === $role){
                    return $next($request);
                }
            }
            return redirect()->route('404');
        }
        return $next($request);
    }
}
