<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class RoleController extends Controller
{

    function __construct()
    {
        $this->middleware('role_has_permission:roles.index|roles.create|roles.edit|roles.delete', ['only' => ['index']]);
        $this->middleware('role_has_permission:roles.create', ['only' => ['create', 'store']]);
        $this->middleware('role_has_permission:roles.edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_has_permission:roles.delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $keyword = strtolower($request->query('keyword'));

        $perPage = 10;
        $currentPage = $request->query("page", 1);
        $offset = ($currentPage * $perPage) - $perPage;

        $roles = Role::with([
            "permissions" => fn ($q) => $q->select("name")->orderBy("name", "ASC")
        ])->when($keyword, fn ($q) => $q->where("name", "ILIKE", "$keyword%"))
            ->where("name",  "!=", "ROOT") //* dont get ROOT role information
            ->offset($offset)->limit($perPage)
            ->orderBy('updated_at', 'DESC')->get();

        $roles = collect($roles)->map(function ($role) {
            return collect($role)->merge([
                'permissions' => collect($role->permissions)->pluck("name")
            ]);
        });

        $roles = new Paginator($roles, $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return Inertia::render('Role/Index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy("name", "ASC")->get("name")->pluck("name");
        return Inertia::render('Role/Create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $permissions = Permission::get("name")->pluck("name")->toArray();

        $request->validate([
            'name' => 'required|string|min:2|unique:roles,name',
            'permissions' => [
                "present", "distinct",
            ],
        ]);

        if (!empty($request->get("permissions", []))) {
            collect($request->get("permissions"))->each(function ($permName)  use ($permissions) {
                if (!in_array($permName, $permissions))
                    return redirect()->back()
                        ->withErrors(['permissions' => ["The selected permissions is invalid."]/**/])
                        ->throwResponse();
            });
        }

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')
            ->with('message', 'Role created successfully');
    }

    public function edit(Request $request, Role $role)
    {
        // prevent edit role named "ROOT"
        if ($role->name == "ROOT") abort(403);

        $permissions = Permission::orderBy("name", "ASC")->get("name")->pluck("name");
        $role = $role->load(["permissions" => fn ($q) => $q->select('name')]);
        $role = collect($role)->merge([
            'permissions' =>  collect($role->permissions)->pluck("name")
        ]);

        return Inertia::render('Role/Edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        // prevent update role named "ROOT"
        if ($role->name == "ROOT") abort(403);

        $permissions = Permission::get("name")->pluck("name")->toArray();

        $request->validate([
            'name' => 'required|string|min:2|unique:roles,name,' . $role->id,
            'permissions' => [
                "present", "distinct",
            ],
        ]);
        if (!empty($request->get("permissions", []))) {
            collect($request->get("permissions"))->each(function ($permName)  use ($permissions) {
                if (!in_array($permName, $permissions))
                    return redirect()->back()
                        ->withErrors(['permissions' => ["The selected permissions is invalid."]/**/])
                        ->throwResponse();
            });
        }

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')
            ->with('message', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        // prevent delete role named "ROOT"
        if ($role->name == "ROOT") abort(403);

        $role->delete();
        return redirect()->route('roles.index')
            ->with('message', 'Role deleted successfully');
    }
}
