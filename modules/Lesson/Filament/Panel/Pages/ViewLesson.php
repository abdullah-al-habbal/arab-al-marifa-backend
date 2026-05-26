<?php
declare(strict_types=1);

namespace Modules\Lesson\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Lesson\Filament\Panel\LessonResource;

class ViewLesson extends ViewRecord
{
    protected static string $resource = LessonResource::class;
}
