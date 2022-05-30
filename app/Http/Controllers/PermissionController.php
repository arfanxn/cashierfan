<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PermissionController extends Controller
{
    public  function __invoke(Request $request)
    {
        return Inertia::render('PermissionIndex');
    }
}
