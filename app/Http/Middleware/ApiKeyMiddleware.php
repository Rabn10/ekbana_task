<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $expectedApiKey = env('API_KEY', 'BA673A414C3B44C98478BB5CF10A0F832574090C');

        $apiKey = $request->header('API_KEY');

        if (!$apiKey || $apiKey !== $expectedApiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Invalid API Key'
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
