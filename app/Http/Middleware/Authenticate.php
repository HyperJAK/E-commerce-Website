<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        return $request->expectsJson() ? null : route('signin');
    }

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('/')->with('error', 'You are not logged in.');

        return $next($request);
    
        }
    
    }
}
