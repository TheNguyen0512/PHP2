<?php

namespace App\Http\Middleware;

use Closure;

class ResetPassPageAccess
{
    public function handle($request, Closure $next)
    {
        $data = $request->session()->get('change_password_data');
        if ( $data == null) {
            return abort(404);
        }
        return $next($request);
    }
}
