<?php
declare(strict_types=1);

namespace Modules\Unit\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Unit\Filament\Panel\Admin\UnitResource;

class ViewUnit extends ViewRecord
{
    protected static string $resource = UnitResource::class;
}
