<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class apiauthcheck
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

        $account = $request->account;
        $token = $request->token;
        if (empty($token)) {
            return response(['success' => false, 'msg' => '權限驗證錯誤']);
        } else {
            $result = DB::table('auth')
                ->where('account', '=', $account)
                ->where('token', '=', $token)
                ->get();
            if (count($result) == 0) {
                return response(['success' => false, 'msg' => '權限驗證錯誤']);
            } else {
                return $next($request);
            }
        }

    }
}
