<?php

declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel\Pages;

use Modules\LessonAttachment\Filament\Panel\LessonAttachmentResource;

class CreateLessonAttachment extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = LessonAttachmentResource::class;
}
