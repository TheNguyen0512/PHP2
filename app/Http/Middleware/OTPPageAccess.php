<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isEmpty;

class OTPPageAccess
{
    public function handle($request, Closure $next)
    {
        $otpData = $request->session()->get('otp_data');
        Log::info($otpData);
        if ($otpData == null) {
            abort(404);
        }
        return $next($request);
    }
}
