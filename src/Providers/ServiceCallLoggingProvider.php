<?php

/**
 * Avoid unexpected return types
 */
declare(strict_types=1);

namespace Arbory\SoapLogger\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ServiceCallLoggingProvider
 * @package Leonardo\Arbory\Soap\Providers
 */
class ServiceCallLoggingProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}