<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in and is an admin
        if ($request->user() && $request->user()->is_admin){
            return $next($request);
        }
        // Redirect non-admin users
        return redirect('/')->with('error', 'Unauthorized access.');
        
    }
}
