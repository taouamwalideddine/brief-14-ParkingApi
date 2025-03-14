<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsRegular
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->role === 'user') {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized. User access required.'], 403);
    }
}
