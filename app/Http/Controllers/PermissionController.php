<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'permission:permissions.index|permissions.create|permissions.edit|permissions.delete',
            ['only' => ['index', 'store']]
        );
        $this->middleware('permission:permissions.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permissions.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permissions.delete', ['only' => ['destroy']]);
    }

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
