<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $agent =  Auth::guard('api')->user();
        if (!$agent)
            return response()->json($this->errorHandle('Please login to access this page'));

        return $next($request);
    }

    private function errorHandle($message = '')
    {
        return ['status' => 'error', 'code' => 401, 'message' => $message];
    }
}
