<?php

declare(strict_types=1);

namespace Modules\CourseType\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\CourseType\Filament\Panel\Admin\CourseTypeResource;

class ViewCourseType extends ViewRecord
{
    protected static string $resource = CourseTypeResource::class;
}
