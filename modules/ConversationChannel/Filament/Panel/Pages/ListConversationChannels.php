<?php

declare(strict_types=1);

namespace Modules\ConversationChannel\Filament\Panel\Pages;

use Modules\ConversationChannel\Filament\Panel\ConversationChannelResource;

class ListConversationChannels extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = ConversationChannelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
