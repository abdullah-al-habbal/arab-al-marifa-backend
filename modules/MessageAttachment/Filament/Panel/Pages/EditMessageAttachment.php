<?php

declare(strict_types=1);

namespace Modules\MessageAttachment\Filament\Panel\Pages;

use Modules\MessageAttachment\Filament\Panel\MessageAttachmentResource;

class EditMessageAttachment extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = MessageAttachmentResource::class;
}
