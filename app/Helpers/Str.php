<?php

namespace App\Helpers;

class Str
{
    static function random($length = 16, $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789")
    {
        return substr(str_shuffle($chars), 0, $length);
    }
}
