<?php

/**
 * Avoid unexpected return types
 */
declare(strict_types=1);

namespace Leonardo\Arbory\Soap\Listeners;

use Leonardo\Arbory\Soap\Services\ServiceCall;
use Leonardo\Services\Soap\Events\ServiceCall as Event;

/**
 * Class ServiceCallListener
 * @package Leonardo\Arbory\Soap\Listeners
 */
class ServiceCallListener
{
    /**
     * @param Event $call
     * @return void
     */
    public function handle(Event $call): void
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