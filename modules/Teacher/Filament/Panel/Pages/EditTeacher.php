<?php

declare(strict_types=1);

namespace Modules\Teacher\Filament\Panel\Pages;

use Modules\Teacher\Filament\Panel\TeacherResource;

class EditTeacher extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = TeacherResource::class;
}
