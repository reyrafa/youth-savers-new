<?php

namespace App\Http\Middleware;

use App\Models\TransactionModel;
use Closure;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class CheckTransactionRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $id = $request->route('id');
        $transaction = TransactionModel::findOrFail($id);
        $level = $transaction->level_id;

        
        if (auth()->user()->user_type_id != $level+1 && auth()->user()->user_type_id != 4) {
            abort(code: 403);
        }
        return $next($request);

    }
}
