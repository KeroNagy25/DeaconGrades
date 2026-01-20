<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin || !$admin->superadmin) {
            abort(403, ' You are not authorized to enter.');
        }

        return $next($request);
    }
}
