<?php
declare(strict_types=1);

namespace Modules\MessageAttachment\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\MessageAttachment\Filament\Panel\Admin\MessageAttachmentResource;

class ViewMessageAttachment extends ViewRecord
{
    protected static string $resource = MessageAttachmentResource::class;
}
