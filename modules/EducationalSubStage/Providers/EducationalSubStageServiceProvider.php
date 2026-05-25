<?php

declare(strict_types=1);

namespace Modules\EducationalSubStage\Providers;

use Illuminate\Support\ServiceProvider;

class EducationalSubStageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
