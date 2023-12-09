<?php

namespace App\Http\Middleware;

use App\Support\ResponseSupport;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    use ResponseSupport;

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('api')->check()) {
            return $next($request);
        }

        return $this->message('Unauthenticated.', Response::HTTP_UNAUTHORIZED);
    }
}
