<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Response as HttpResponse;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('sanctum')->user() || auth('sanctum-driver')->user()) {
            return $next($request);
        }
        

        return response()->json([ "message" => "unauthorized" ], HttpResponse::HTTP_UNAUTHORIZED);

        // return response()->json('Your account is inactive');
        // return $next($request);
    }
}
