<?php

declare(strict_types=1);

namespace Modules\Lesson\Filament\Panel\Admin\Pages;

use Modules\Lesson\Filament\Panel\Admin\LessonResource;

class ListLessons extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
