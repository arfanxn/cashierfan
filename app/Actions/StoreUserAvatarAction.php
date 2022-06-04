<?php

namespace App\Actions;

use App\Helpers\Str;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class StoreUserAvatarAction
{
    private const FILEPATH = "users/avatars";

    public static function exec(User $user, \Illuminate\Http\UploadedFile|null $file = null)
    {
        if ($file === null) return false;

        $fileName = Str::random() . now()->timestamp . "." . $file->extension();

        Storage::putFileAs("public/" . static::FILEPATH, $file, $fileName);

        return
            $user->details()->update([
                'avatar' => Storage::url(static::FILEPATH . "/" . $fileName)
            ]);
    }
}
