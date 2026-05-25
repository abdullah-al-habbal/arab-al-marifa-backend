<?php

declare(strict_types=1);

namespace Modules\QuestionBank\Providers;

use Illuminate\Support\ServiceProvider;

final class QuestionBankServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
