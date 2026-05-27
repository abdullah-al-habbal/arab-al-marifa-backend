<?php

declare(strict_types=1);

namespace Modules\Lesson\Filament\Panel\Admin\Pages;

use Modules\Lesson\Filament\Panel\Admin\LessonResource;

class EditLesson extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = LessonResource::class;
}
