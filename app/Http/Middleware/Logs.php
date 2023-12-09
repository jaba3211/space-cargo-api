<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Domains\Logs\Queries\LogQuery;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Logs
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        $startDate = Carbon::now()->format('Y-m-d H:i:s');
        $logQuery = new LogQuery();
        $startTime = microtime(true);
        $response = $next($request);
        $endTime = microtime(true);
        $executionTime = round($endTime - $startTime, 2);

        $logQuery->create(
            sessionId: session()->getId(),
            ipAddress: $request->ip(),
            method: $request->method(),
            uri: $request->path(),
            parameters: json_encode($this->getParameters($request->all())),
            response: $response->getContent(),
            startDate: $startDate,
            executionTime: $executionTime
        );

        return $response;
    }

    /**
     * @param $parameters
     * @return mixed
     */
    private function getParameters($parameters): mixed
    {
        if (isset($parameters['password'])) {
            $parameters['password'] = '*';
        }
        return $parameters;
    }
}
