<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductIndexResponse
{
    public static function make($data)
    {
        if (request()->wantsJson() || request()->expectsJson())
            return response()->json($data);

        return Inertia::render("Product/Index", $data);
    }
}
