<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuthentification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /*
        $auth = Auth::user();

        if (is_null($auth))
            return response('Access denied', 403);

        // rejecting for guests
        if (Auth::guard()->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        if (is_null($request->user())) {
            return response('Bad request', 403);
        }

        if (! $request->user()->isAdmin()) {
            return response('Access denied.', 401);
        }

        return $next($request);
        */

        $auth_user = Auth::user();

        if (Auth::guard()->guest()){
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            }
            else {
                return redirect()->guest('login');
            }
        }

        if (! $auth_user || ! $request->user()){
            return response('Bad request', 403);
        }

        if (! $request->user()->hasAdminPanelAccess()) {
            return response('Access denied.', 401);
        }

        return $next($request);
    }
}
