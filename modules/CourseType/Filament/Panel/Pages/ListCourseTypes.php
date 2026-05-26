<?php

declare(strict_types=1);

namespace Modules\CourseType\Filament\Panel\Pages;

use Modules\CourseType\Filament\Panel\CourseTypeResource;

class ListCourseTypes extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = CourseTypeResource::class;

}
