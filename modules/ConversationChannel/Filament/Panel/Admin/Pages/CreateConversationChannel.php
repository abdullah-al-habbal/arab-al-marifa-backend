<?php

declare(strict_types=1);

namespace Modules\ConversationChannel\Filament\Panel\Admin\Pages;

use Modules\ConversationChannel\Filament\Panel\Admin\ConversationChannelResource;

class CreateConversationChannel extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = ConversationChannelResource::class;
}
