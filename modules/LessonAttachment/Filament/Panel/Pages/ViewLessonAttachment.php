<?php
declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\LessonAttachment\Filament\Panel\LessonAttachmentResource;

class ViewLessonAttachment extends ViewRecord
{
    protected static string $resource = LessonAttachmentResource::class;
}
