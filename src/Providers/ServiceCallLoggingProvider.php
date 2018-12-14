<?php

/**
 * Avoid unexpected return types
 */
declare(strict_types=1);

namespace Leonardo\Arbory\Soap\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Leonardo\Arbory\Soap\Listeners\ServiceCallListener;
use Leonardo\Services\Soap\Events\ServiceCall;

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
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        Event::listen(ServiceCall::class, ServiceCallListener::class);
    }
}