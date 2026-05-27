<?php

declare(strict_types=1);

namespace Modules\Lesson\Filament\Panel\Admin\Pages;

use Modules\Lesson\Filament\Panel\Admin\LessonResource;

class CreateLesson extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = LessonResource::class;
}
