<?php

declare(strict_types=1);

namespace Modules\Exam\Providers;

use Illuminate\Support\ServiceProvider;

final class ExamServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
