<?php

declare(strict_types=1);

namespace Modules\CourseType\Filament\Panel\Admin\Pages;

use Modules\CourseType\Filament\Panel\Admin\CourseTypeResource;

class EditCourseType extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = CourseTypeResource::class;
}
