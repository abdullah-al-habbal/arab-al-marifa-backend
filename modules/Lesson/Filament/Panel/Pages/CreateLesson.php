<?php

declare(strict_types=1);

namespace Modules\Lesson\Filament\Panel\Pages;

use Modules\Lesson\Filament\Panel\LessonResource;

class CreateLesson extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = LessonResource::class;
}
