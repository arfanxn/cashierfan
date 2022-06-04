<?php

namespace App\Services;

use App\Helpers\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class VerificationCodeService
{
    private string $dbTable = "verification_codes";
    public string $verifiable, $code;

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

        DB::table($this->dbTable)->updateOrInsert([
            "verifiable" => $this->verifiable,
        ], [
            "verifiable" => $this->verifiable,
            "code" => $this->code,
            "expired_at" => now()->addMinutes($expireInMinutes),
        ]);

        return $this;
    }

    public function send()
    {
        $this->code = $this->code ?? $this->fresh()->code;

        // Notification::send(); // do something with notification
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
            response()->json([
                "errors" => [
                    "verification_code" => "Verification Code is incorrect",
                ]
            ])->throwResponse();
            exit();
        }

        if ($isCodeMatch) $query->delete();

        return $isCodeMatch;
    }
}
