<?php
declare(strict_types=1);

namespace Modules\LessonAttachment\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\LessonAttachment\Filament\Panel\Admin\LessonAttachmentResource;

class ViewLessonAttachment extends ViewRecord
{
    protected static string $resource = LessonAttachmentResource::class;
}
