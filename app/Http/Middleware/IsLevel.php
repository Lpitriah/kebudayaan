<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLevel
{
    public function handle(Request $request, Closure $next, ...$levels): Response
    {
        $user = auth()->user();

        if (! $user || ! in_array($user->level, $levels)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
