<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClerkAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! session('clerk_user')) {
            return redirect()->route('auth.sign-in')
                ->with('intended', $request->url());
        }

        return $next($request);
    }
}
