<?php

declare(strict_types=1);

namespace Modules\StaticPage\Filament\Panel\Admin\Pages;

use Modules\StaticPage\Filament\Panel\Admin\StaticPageResource;

class CreateStaticPage extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = StaticPageResource::class;
}
