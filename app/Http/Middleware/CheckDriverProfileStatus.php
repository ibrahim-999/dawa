<?php

namespace App\Http\Middleware;

use App\Domains\Driver\v1\Enums\DriverStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class CheckDriverProfileStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('sanctum-driver')->user()->status == DriverStatusEnum::APPROVED->value) {
            return $next($request);
        }

        return response()->json( $next($request)->original,HttpResponse::HTTP_FOUND)->header('X-Driver-Status', auth('sanctum-driver')->user()->status);

    }
}
