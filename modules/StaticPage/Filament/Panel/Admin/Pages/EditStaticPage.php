<?php

declare(strict_types=1);

namespace Modules\StaticPage\Filament\Panel\Admin\Pages;

use Modules\StaticPage\Filament\Panel\Admin\StaticPageResource;

class EditStaticPage extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = StaticPageResource::class;
}
