<?php

namespace App\Http\Middleware;

use App\Models\Admin\Permission;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RegisterGate
{
    public function handle(Request $request, Closure $next)
    {
        $auth_user = \Auth::user();

        if ($auth_user) {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->slug, function (User $user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        }

        return $next($request);
    }
}
