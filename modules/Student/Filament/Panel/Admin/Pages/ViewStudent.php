<?php
declare(strict_types=1);

namespace Modules\Student\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Student\Filament\Panel\Admin\StudentResource;

class ViewStudent extends ViewRecord
{
    protected static string $resource = StudentResource::class;
}
