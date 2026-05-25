<?php

declare(strict_types=1);

namespace Modules\ConversationChannel\Providers;

use Illuminate\Support\ServiceProvider;

final class ConversationChannelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
