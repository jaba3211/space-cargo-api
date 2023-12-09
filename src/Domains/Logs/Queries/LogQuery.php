<?php

namespace Domains\Logs\Queries;

use App\Models\Log;
use App\Queries\BaseQuery;

class LogQuery extends BaseQuery
{

    /**
     * @param string $sessionId
     * @param string $ipAddress
     * @param string $method
     * @param string $uri
     * @param string|null $parameters
     * @param string|null $response
     * @param string|null $errorMessage
     * @param string $startDate
     * @param string $executionTime
     * @return mixed
     */
    public function create(
        string  $sessionId,
        string  $ipAddress,
        string  $method,
        string  $uri,
        ?string $parameters,
        ?string $response,
        string  $startDate,
        string  $executionTime,
    ): mixed
    {
        return Log::create([
            'session_id' => $sessionId,
            'ip_address' => $ipAddress,
            'method' => $method,
            'uri' => $uri,
            'parameters' => $parameters,
            'response' => $response,
            'start_date' => $startDate,
            'execution_time' => $executionTime,
        ]);

    }
}
