<?php

declare(strict_types=1);

namespace Modules\Question\Providers;

use Illuminate\Support\ServiceProvider;

final class QuestionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
