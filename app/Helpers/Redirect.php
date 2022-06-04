<?php

namespace App\Helpers;

use \Illuminate\Http\RedirectResponse;
use \Illuminate\Routing\Redirector;
use Illuminate\Http\Exceptions\HttpResponseException;

class Redirect
{
    static function now(Redirector|RedirectResponse $redirect)
    {
        throw new HttpResponseException($redirect);
        return  exit();
    }
}
