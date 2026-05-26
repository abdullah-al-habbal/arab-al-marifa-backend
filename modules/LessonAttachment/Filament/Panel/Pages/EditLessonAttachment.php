<?php

declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel\Pages;

use Modules\LessonAttachment\Filament\Panel\LessonAttachmentResource;

class EditLessonAttachment extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = LessonAttachmentResource::class;
}
