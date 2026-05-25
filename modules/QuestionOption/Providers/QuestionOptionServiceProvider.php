<?php

declare(strict_types=1);

namespace Modules\QuestionOption\Providers;

use Illuminate\Support\ServiceProvider;

final class QuestionOptionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
