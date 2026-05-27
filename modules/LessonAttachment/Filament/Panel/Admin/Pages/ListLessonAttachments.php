<?php

declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel\Admin\Pages;

use Modules\LessonAttachment\Filament\Panel\Admin\LessonAttachmentResource;

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
