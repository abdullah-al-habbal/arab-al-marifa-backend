<?php

declare(strict_types=1);

namespace Modules\Subject\Providers;

use Illuminate\Support\ServiceProvider;

final class SubjectServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
