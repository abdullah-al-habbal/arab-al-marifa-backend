<?php

declare(strict_types=1);

namespace Modules\LessonAttachment\Providers;

use Illuminate\Support\ServiceProvider;

final class LessonAttachmentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
