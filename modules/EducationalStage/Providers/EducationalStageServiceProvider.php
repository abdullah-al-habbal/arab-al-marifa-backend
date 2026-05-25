<?php

declare(strict_types=1);

namespace Modules\EducationalStage\Providers;

use Illuminate\Support\ServiceProvider;

class EducationalStageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
