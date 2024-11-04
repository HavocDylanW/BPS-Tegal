<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles  // Accept multiple roles as arguments
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        }

        $user = Auth::user();

        // Check if the user has any of the required roles
        if ($user->roles->pluck('name')->intersect($roles)->isNotEmpty()) {
            return $next($request);
        }

        // Redirect to unauthorized page if no matching role is found
        return redirect()->route('unauthorized');
    }
}
