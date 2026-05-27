<?php
declare(strict_types=1);

namespace Modules\Lesson\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Lesson\Filament\Panel\Admin\LessonResource;

class ViewLesson extends ViewRecord
{
    protected static string $resource = LessonResource::class;
}
