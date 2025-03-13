<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
    {
        // Check if the session token exists and is valid
        if (!$request->session()->has('token') || !$this->isValidToken($request->session()->get('token'))) {
            // If not valid, redirect to login page with an error
            return redirect('/')->withErrors(['token' => 'Unauthorized access. Please login again.']);
        }
        return $next($request);
    }

    private function isValidToken($token)
    {
        // Implement token validation logic here
        // This is a placeholder logic; replace it with actual token validation, e.g., checking against a database or external API
        return true;  // Assume token is valid for demonstration
    }
}
