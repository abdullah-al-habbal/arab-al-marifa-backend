<?php

declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel\Admin\Pages;

use Modules\LessonAttachment\Filament\Panel\Admin\LessonAttachmentResource;

class CreateLessonAttachment extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = LessonAttachmentResource::class;
}
