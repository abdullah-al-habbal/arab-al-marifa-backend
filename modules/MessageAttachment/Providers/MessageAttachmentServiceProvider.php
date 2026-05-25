<?php

declare(strict_types=1);

namespace Modules\MessageAttachment\Providers;

use Illuminate\Support\ServiceProvider;

final class MessageAttachmentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
