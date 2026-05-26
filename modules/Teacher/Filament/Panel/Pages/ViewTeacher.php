<?php
declare(strict_types=1);

namespace Modules\Teacher\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Teacher\Filament\Panel\TeacherResource;

class ViewTeacher extends ViewRecord
{
    protected static string $resource = TeacherResource::class;
}
