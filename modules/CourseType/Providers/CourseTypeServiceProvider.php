<?php

declare(strict_types=1);

namespace Modules\CourseType\Providers;

use Illuminate\Support\ServiceProvider;

class CourseTypeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
