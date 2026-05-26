<?php

declare(strict_types=1);

namespace Modules\CourseType\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\CourseType\Filament\Panel\CourseTypeResource;

class ViewCourseType extends ViewRecord
{
    protected static string $resource = CourseTypeResource::class;
}
