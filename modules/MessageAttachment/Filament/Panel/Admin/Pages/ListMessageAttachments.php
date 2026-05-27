<?php

declare(strict_types=1);

namespace Modules\MessageAttachment\Filament\Panel\Admin\Pages;

use Modules\MessageAttachment\Filament\Panel\Admin\MessageAttachmentResource;

class ListMessageAttachments extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = MessageAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
