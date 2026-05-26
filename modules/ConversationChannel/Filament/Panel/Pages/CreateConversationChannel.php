<?php

declare(strict_types=1);

namespace Modules\ConversationChannel\Filament\Panel\Pages;

use Modules\ConversationChannel\Filament\Panel\ConversationChannelResource;

class CreateConversationChannel extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = ConversationChannelResource::class;
}
