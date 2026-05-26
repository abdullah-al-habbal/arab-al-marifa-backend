<?php

declare(strict_types=1);

namespace Modules\Teacher\Filament\Panel\Pages;

use Modules\Teacher\Filament\Panel\TeacherResource;

class CreateTeacher extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = TeacherResource::class;
}
