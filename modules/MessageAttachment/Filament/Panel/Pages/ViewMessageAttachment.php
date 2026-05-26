<?php
declare(strict_types=1);

namespace Modules\MessageAttachment\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\MessageAttachment\Filament\Panel\MessageAttachmentResource;

class ViewMessageAttachment extends ViewRecord
{
    protected static string $resource = MessageAttachmentResource::class;
}
