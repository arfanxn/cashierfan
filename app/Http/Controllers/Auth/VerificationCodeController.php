<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Validation\Rules\RequiredIf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\VerificationCodeService;
use Illuminate\Support\Facades\RateLimiter;

class VerificationCodeController extends Controller
{
    public function send(Request $request)
    {
        $verifiable = VerificationCodeService::valiateVerifiable($request);

        $verificationCode = VerificationCodeService::make($verifiable)->fresh()->send();

        return response()->json(['message' => "Verification Code sent successfully"]);
    }
}
