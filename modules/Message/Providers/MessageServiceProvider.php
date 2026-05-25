<?php

declare(strict_types=1);

namespace Modules\Message\Providers;

use Illuminate\Support\ServiceProvider;

final class MessageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
