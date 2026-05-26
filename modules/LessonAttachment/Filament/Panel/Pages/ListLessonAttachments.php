<?php

declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel\Pages;

use Modules\LessonAttachment\Filament\Panel\LessonAttachmentResource;

class ListLessonAttachments extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = LessonAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
