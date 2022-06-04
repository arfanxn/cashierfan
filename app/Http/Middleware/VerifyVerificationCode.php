<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\VerificationCodeService;
use Closure;
use Illuminate\Validation\Rules\RequiredIf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class VerifyVerificationCode
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
        $verifiable = VerificationCodeService::valiateVerifiable($request);
        $code = VerificationCodeService::validateCode($request);

        $isVerified = VerificationCodeService::make($verifiable)->verify($code, false);

        // do something after verification
        if ($isVerified) {
            return $next($request);
        }
    }
}
