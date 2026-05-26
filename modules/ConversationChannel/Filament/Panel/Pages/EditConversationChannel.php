<?php

declare(strict_types=1);

namespace Modules\ConversationChannel\Filament\Panel\Pages;

use Modules\ConversationChannel\Filament\Panel\ConversationChannelResource;

class EditConversationChannel extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = ConversationChannelResource::class;
}
