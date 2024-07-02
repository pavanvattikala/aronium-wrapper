<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // check if type is present
        if (!$request->has('type')) {
            return response()->json(['error' => 'Type is required'], 400);
        }
        // get type fom url parameter
        $type = $request->type;

        $allowd_types = ['repairs', 'sales'];

        // check if type is allowed
        if (!in_array($type, $allowd_types)) {
            return response()->json(['error' => 'Type is not allowed'], 400);
        }

        return $next($request);
    }
}
