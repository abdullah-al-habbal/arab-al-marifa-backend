<?php

declare(strict_types=1);

namespace Modules\StaticPage\Filament\Panel\Pages;

use Modules\StaticPage\Filament\Panel\StaticPageResource;

class CreateStaticPage extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = StaticPageResource::class;
}
