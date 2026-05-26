<?php
declare(strict_types=1);

namespace Modules\Unit\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Unit\Filament\Panel\UnitResource;

class ViewUnit extends ViewRecord
{
    protected static string $resource = UnitResource::class;
}
