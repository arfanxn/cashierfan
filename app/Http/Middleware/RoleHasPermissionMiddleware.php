<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Role;

class RoleHasPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $permissions, $guard = null)
    {
        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        // (new Role())->hasAnyPermission();

        $permissions = is_array($permissions)
            ? $permissions
            : explode('|', $permissions);

        $role = $authGuard->user()->roles()->first();

        $hasPermissions = $role->hasAnyPermission($permissions);

        if ($hasPermissions) {
            return $next($request);
        }

        // foreach ($permissions as $permission) {
        //     if ($authGuard->user()->can($permission)) {
        //         return $next($request);
        //     }
        // }

        throw UnauthorizedException::forPermissions($permissions);
    }
}
