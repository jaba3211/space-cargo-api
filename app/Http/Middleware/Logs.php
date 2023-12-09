<?php

namespace App\Http\Middleware;

use App\Support\ResponseSupport;
use Carbon\Carbon;
use Closure;
use Domains\Logs\Queries\LogQuery;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Logs
{
    use ResponseSupport;

    private LogQuery $logQuery;

    public function __construct(LogQuery $logQuery)
    {
        $this->logQuery = $logQuery;
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next)
    {
        $startDate = Carbon::now()->format('Y-m-d H:i:s');
        $startTime = microtime(true);
        try {
            $response = $next($request);
            $this->createLog(
                request: $request,
                response: $response->getContent(),
                startDate: $startDate,
                startTime: $startTime
            );

            return $response;
        } catch (Exception $exception) {
            $this->createLog(
                request: $request,
                response: $this->error($exception),
                startDate: $startDate,
                startTime: $startTime
            );
            return $this->error($exception);
        }

    }

    private function createLog(
        Request $request,
        string  $response,
        string  $startDate,
        string  $startTime
    ): void
    {
        $endTime = microtime(true);
        $executionTime = round($endTime - $startTime, 2);
        $this->logQuery->create(
            sessionId: session()->getId(),
            ipAddress: $request->ip(),
            method: $request->method(),
            uri: $request->path(),
            parameters: json_encode($this->getParameters($request->all())),
            response: json_encode($response),
            startDate: $startDate,
            executionTime: $executionTime
        );
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
