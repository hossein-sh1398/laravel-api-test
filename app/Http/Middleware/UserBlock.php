<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (! auth()->user()->is_block) {
                return $next($request);
            }
        }
         return response()->json([
            'message' => 'access forbidden'
         ], Response::HTTP_FORBIDDEN);       
    }
}
