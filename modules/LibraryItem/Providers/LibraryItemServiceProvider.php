<?php

declare(strict_types=1);

namespace Modules\LibraryItem\Providers;

use Illuminate\Support\ServiceProvider;

final class LibraryItemServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
