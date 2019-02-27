<?php

/**
 * Avoid unexpected return types
 */
declare(strict_types=1);

namespace Arbory\SoapLogger\Listeners;

use Arbory\SoapLogger\Services\ServiceCall;

/**
 * Class ServiceCallListener
 * @package Leonardo\Arbory\Soap\Listeners
 */
class ServiceCallListener
{
    /**
     * @return void
     */
    public function handle($call): void
    {
        ServiceCall::create([
            'request_body' => $call->getRequestBody(),
            'response_body' => $call->getResponseBody(),
            'request_headers' => $call->getRequestHeaders(),
            'response_headers' => $call->getResponseHeaders(),
            'status' => $call->getHttpStatus(),
            'environment' => $call->getServiceEnvironment(),
            'method' => $call->getServiceMethod(),
            'path' => $call->getServicePath(),
        ]);
    }
}