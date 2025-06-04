<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeveloperAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $developerPass = 'HelloDevSaikat' . date('Y');

        $provided = $request->query('password') ?? $request->header('X-Dev-Password');

        if ($provided !== $developerPass) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}