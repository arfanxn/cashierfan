<?php

namespace App\Http\Controllers;

use App\Actions\StoreUserAvatarAction;
use App\Helpers\Str;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Image;

class UserController extends Controller
{
    public function __construct(Request $request, User $user)
    {
        $this->middleware('permission:users.index|users.create|users.edit|users.delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:users.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:users.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:users.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = strtolower($request->get('keyword'));

        $users = User::with(["details", "roles"]);

        if ($keyword) {
            $users = $users->where(function ($query) use ($keyword) {
                $query->where(
                    "name",
                    "ILIKE",
                    "$keyword%"
                )->orWhere(
                    "email",
                    "ILIKE",
                    "$keyword%"
                )->orWhereHas(
                    "details",
                    function ($query) use ($keyword) {
                        return $query->where("phone_number", "ILIKE", "$keyword%");
                    }
                )->orWhereHas(
                    "roles",
                    function ($query) use ($keyword) {
                        return $query->where("name", "ILIKE", "$keyword%");
                    }
                );;
            });
        }

        $users = $users->orderBy("updated_at", "DESC")->simplePaginate(10);


        return Inertia::render('User/Index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::query()->whereNot('name', "Root")->orderBy("name", "ASC")->get(['name'])->pluck('name');

        return Inertia::render('User/Create', compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create(
            collect($request->only([
                'name', "email",
            ]))->merge(["password" => bcrypt($request->password)])->toArray()
        );

        $user->details()->create(
            array_merge($request->only(["phone_number", "address"]), [
                "avatar" => "#" . Str::random(6, "0123456789ABCDEF")
            ]/**/)
        );

        StoreUserAvatarAction::exec($user, $request->file("avatar"));

        // give user role
        $user->syncRoles($request->get('role'));

        // give user permissions
        $permissions = Role::whereName($request->get('role'))->first()->getPermissionNames() ?? [];
        $user->syncPermissions($permissions);
        // end of give user permissions

        return redirect()->route("users.index")->with(['message' => "User created successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::denyIf(
            auth()->id() == $user->id,
            "Cannot edit your own account, go to \"Account Settings\" to edit your account",
            403
        );

        $user = $user->load("details");

        $user = collect($user)->merge(["role" => $user->getRoleNames()->first()]);

        $roles = Role::query()->whereNot('name', "Root")->orderBy("name", "ASC")->get(['name'])->pluck('name');

        return Inertia::render('User/Edit', compact("user", "roles"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::denyIf(
            auth()->id() == $user->id,
            "Cannot edit your own account, go to \"Account Settings\" to edit your account",
            403
        );

        // update user credentials
        $user->update(
            $request->get("password") ?
                collect($request->only(["name", "email",]))
                ->merge(["password" => bcrypt($request->password)])->toArray()
                : $request->only(["name", "email",])
            /**/
        );

        StoreUserAvatarAction::exec($user, $request->file("avatar"));

        $user->details()->update($request->only(["phone_number", "address"])/**/);

        // update user role
        $user->syncRoles($request->get('role'));

        // update user permissions
        $permissions = Role::whereName($request->get('role'))->first()->getPermissionNames() ?? [];
        $user->syncPermissions($permissions);
        // end of update user permissions

        $user->touch(); // update the user updated_at column 

        return redirect()->route("users.index")
            ->with(["message" => 'User "' . $user->name . '" updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Gate::denyIf(auth()->id() == $user->id, "Cannot delete your own account", 403);

        $user->delete(); // delete the user from database ;

        return redirect()->route("users.index")
            ->with(["message" => 'User "' . $user->name . '" deleted successfully']);
    }
}
