<?php

declare(strict_types=1);

namespace Modules\ExamAttempt\Providers;

use Illuminate\Support\ServiceProvider;

final class ExamAttemptServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
