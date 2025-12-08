<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleOrPermission
{
   public function handle(Request $request, Closure $next, ...$rolesOrPermissions)
{
    $user = Auth::user();

    if (!$user) {
        abort(403, 'Unauthorized. Please login.');
    }

    // Special case: admin can do everything
    if ($user->hasRole('admin')) {
        return $next($request);
    }

    // Check if user has any of the roles or permissions
    foreach ($rolesOrPermissions as $roleOrPermission) {
        if ($user->hasRole($roleOrPermission) || $user->can($roleOrPermission)) {
            return $next($request);
        }
    }

    // Better error message
    $routeName = $request->route()->getName();
    $required = implode(', ', $rolesOrPermissions);
    $userRoles = implode(', ', $user->getRoleNames()->toArray());

    abort(403, "Access denied for route: {$routeName}. Required: {$required}. Your roles: {$userRoles}");
}
}
