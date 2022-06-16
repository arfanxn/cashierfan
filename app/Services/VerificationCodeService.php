<?php

namespace App\Services;

use App\Helpers\Redirect;
use App\Helpers\Str;
use App\Models\User;
use App\Notifications\VerificationCodeNotification;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\RequiredIf;

class VerificationCodeService
{
    private string $dbTable = "verification_codes";
    public string $verifiable, $code;
    public \Carbon\Carbon $expiredAt;

    private function __construct($verifiable)
    {
        $this->verifiable = $verifiable;
    }
    public static function make(string $verifiable): static
    {
        return new static($verifiable);
    }


    public function fresh(int $expireInMinutes  = 30)
    {
        $this->code = Str::random(6, "0123456789");

        $this->expiredAt = now()->addMinutes($expireInMinutes);

        DB::table($this->dbTable)->updateOrInsert([
            "verifiable" => $this->verifiable,
        ], [
            "verifiable" => $this->verifiable,
            "code" => $this->code,
            "expired_at" => $this->expiredAt,
        ]);

        return $this;
    }

    public function send(User|string|null $notifiable = null)
    {
        $this->code = $this->code ?? $this->fresh()->code;

        if (is_null($notifiable))
            $notifiable = $this->verifiable;

        if ($notifiable instanceof User)
            Notification::sendNow(
                $notifiable,
                new VerificationCodeNotification($this->code, $this->expiredAt)
            );
        else  if (is_string($notifiable))
            Notification::route("mail", $notifiable)->notify(
                new VerificationCodeNotification($this->code, $this->expiredAt)
            );


        Log::info("||| Verification Code for " . $this->verifiable . " is " . $this->code .  " |||");

        return $this;
    }

    public function verify(string $verificationCode, bool $onErrorCustomResponse = false): bool
    {
        $query = DB::table($this->dbTable)
            ->where('verifiable', $this->verifiable)
            ->where("expired_at", ">", now()) ?? null;

        $code = $query->first()->code ?? null;

        $isCodeMatch = $verificationCode === $code;

        if ($onErrorCustomResponse === false && $isCodeMatch === false) {
            $errors = [
                "verification_code" => ["Verification Code is incorrect or expired"],
            ];

            request()->expectsJson() ?
                response()->json(["errors" => $errors])->throwResponse()
                : Redirect::now(redirect()->back()->withErrors($errors));

            return exit();
        }

        if ($isCodeMatch) $query->delete();

        return $isCodeMatch;
    }









    //  static validation methods
    public static function valiateVerifiable(Request $request)
    {
        $validator  = Validator::make($request->only(['email', "phone_number", "verifiable"]), [
            "email" => [
                new RequiredIf(function () use ($request) {
                    return !boolval(/**/$request->verifiable ?? $request->phone_number/**/);
                }), "email"
            ],
            "phone_number" => [
                new RequiredIf(function () use ($request) {
                    return !boolval(/**/$request->verifiable ?? $request->email/**/);
                }),
            ],
            "verifiable" => [new RequiredIf(function () use ($request) {
                return !boolval(/**/$request->email ?? $request->phone_number/**/);
            }), "string"],
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                response()->json(["errors" => $validator->errors()]/**/)->throwResponse();
            } else {
                Redirect::now(
                    redirect()->back()->withErrors($validator->errors())
                );
            }
            return exit();
        }

        $verifiable = $request->verifiable ?? $request->email ?? $request->phone_number;

        return $verifiable;
    }

    public static function validateCode(Request $request)
    {
        $validator = Validator::make(
            $request->only(['verification_code', "code"]),
            [
                'verification_code' =>   [
                    new RequiredIf(function () use ($request) {
                        return !boolval(/**/$request->code/**/);
                    }), "numeric", "digits:6"
                ],
                "code" => [
                    new RequiredIf(function () use ($request) {
                        return !boolval(/**/$request->verification_code/**/);
                    }),
                    "numeric", "digits:6"
                ],
            ]
        );

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                response()->json(["errors" => $validator->errors()]/**/)->throwResponse();
            } else {
                Redirect::now(
                    redirect()->back()->withErrors($validator->errors())
                );
            }
            return exit();
        }

        $code = $validator->validated()['verification_code'] ?? $validator->validated()['code'];

        return $code;
    }
}
