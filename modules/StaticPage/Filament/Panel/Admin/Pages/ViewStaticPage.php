<?php
declare(strict_types=1);

namespace Modules\StaticPage\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\StaticPage\Filament\Panel\Admin\StaticPageResource;

class ViewStaticPage extends ViewRecord
{
    protected static string $resource = StaticPageResource::class;
}
