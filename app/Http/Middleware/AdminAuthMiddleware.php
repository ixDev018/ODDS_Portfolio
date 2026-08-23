<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((!$request->session()->has('odds_admin_logged_in') && !$request->session()->has('admin_logged_in')) || 
            (!$request->session()->get('odds_admin_logged_in') && !$request->session()->get('admin_logged_in'))) {
            return redirect()->route('odds.admin.login')->with('error', 'Please authenticate to access ODDS Admin.');
        }

        return $next($request);
    }
}
