<?php

declare(strict_types=1);

namespace Modules\MessageAttachment\Filament\Panel\Pages;

use Modules\MessageAttachment\Filament\Panel\MessageAttachmentResource;

class CreateMessageAttachment extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = MessageAttachmentResource::class;
}
