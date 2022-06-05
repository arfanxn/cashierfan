<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public  function __invoke(Request $request)
    {
        $keyword = $request->query('keyword');

        $permissions = Permission::query()
            ->when($keyword, fn ($query) => $query->where(
                "name",
                "ILIKE",
                "$keyword%"
            ))->orderBy("name")->get("name")->pluck("name");

        return Inertia::render('PermissionIndex', compact('permissions'));
    }
}
