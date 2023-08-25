<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
	public function handle($request, Closure $next, ...$roles)
	{
		$user = $request->user();

		if (!$user || !$user->hasAnyRole($roles)) {
			return response()->json(['message' => 'Unauthorized'], 401);
		}

		return $next($request);
	}
}
