<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $roles = [
            'admin' => ['1'],
            'ols_officer' => ['2', '3', '4'],
            'new_accounts' => ['3'],
            'ho_personnel' => ['4']
        ];

        $roleIDs = $roles[$role] ?? [];
        if(!in_array(auth()->user()->user_type_id, $roleIDs)){
            abort(code:403);
        }
        return $next($request);
    }
}
