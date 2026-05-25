<?php

declare(strict_types=1);

namespace Modules\SubjectCategory\Providers;

use Illuminate\Support\ServiceProvider;

final class SubjectCategoryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
