<?php

declare(strict_types=1);

namespace Modules\Teacher\Filament\Panel\Admin\Pages;

use Modules\Teacher\Filament\Panel\Admin\TeacherResource;

class EditTeacher extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = TeacherResource::class;
}
