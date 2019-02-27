<?php

namespace Arbory\SoapLogger\Contracts;

interface ArborySoapLoggerEventInterface
{
    public function getRequestBody(): string;

    public function getResponseBody(): string;

    public function getRequestHeaders(): string;

    public function getResponseHeaders(): string;

    public function getHttpStatus(): string;

    public function getServiceEnvironment(): string;

    public function getServiceMethod(): string;

    public function getServicePath(): string;
}