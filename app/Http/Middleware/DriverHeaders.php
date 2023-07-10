<?php

namespace App\Http\Middleware;

use App\Domains\Driver\v1\Enums\DriverStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Symfony\Component\HttpFoundation\Response;

class DriverHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $current_order=auth('sanctum-driver')->user()->currentOrder();
        if ($current_order)
        {
            $response->header('X-CurrentOrder', $current_order->id);
        }
        return $response;
    }
}
