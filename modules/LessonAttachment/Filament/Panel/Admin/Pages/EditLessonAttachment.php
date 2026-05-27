<?php

declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel\Admin\Pages;

use Modules\LessonAttachment\Filament\Panel\Admin\LessonAttachmentResource;

class EditLessonAttachment extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = LessonAttachmentResource::class;
}
