<?php

declare(strict_types=1);

namespace Modules\Teacher\Filament\Panel\Pages;

use Modules\Teacher\Filament\Panel\TeacherResource;

class ListTeachers extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = TeacherResource::class;

}
