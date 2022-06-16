<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'layouts.app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $share = array_merge(parent::share($request), [
            "csrf_token" => csrf_token(),
            "auth" => function () {
                if (Auth::check()) {
                    $user = Auth::user()->load([
                        "roles" => fn ($q) => $q->select("name"),
                        "details",
                    ]);
                    return ([
                        "user" => collect($user)->map(function ($value, $key) {
                            if ($key === "roles")
                                return collect($value)->pluck("name");

                            return $value;
                        })
                            ->merge([
                                'permissions' =>  //$user->roles[0]->getPermissionNames()
                                \Spatie\Permission\Models\Role::where("name", $user->roles[0]['name'])->first()->getPermissionNames()
                            ])
                    ]);
                }
                return false;
            },
            "flash" => [
                "message" => fn () => $request->session()->get('message'),
            ],
        ]);
        return $share;
    }
}
