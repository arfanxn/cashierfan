<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class CustomerIndexResponse
{
    public static function make($data)
    {
        if (request()->wantsJson() || request()->expectsJson())
            return response()->json($data);

        return Inertia::render("Customer/Index", $data);
    }
}
