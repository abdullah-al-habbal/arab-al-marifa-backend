<?php

declare(strict_types=1);

namespace Modules\MessageAttachment\Filament\Panel\Admin\Pages;

use Modules\MessageAttachment\Filament\Panel\Admin\MessageAttachmentResource;

class EditMessageAttachment extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = MessageAttachmentResource::class;
}
