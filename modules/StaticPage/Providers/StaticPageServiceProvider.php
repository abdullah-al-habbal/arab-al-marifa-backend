<?php

declare(strict_types=1);

namespace Modules\StaticPage\Providers;

use Illuminate\Support\ServiceProvider;

final class StaticPageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
