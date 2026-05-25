<?php

declare(strict_types=1);

namespace Modules\VideoFile\Providers;

use Illuminate\Support\ServiceProvider;

final class VideoFileServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
