<?php

declare(strict_types=1);

namespace Modules\ConversationChannel\Filament\Panel\Admin\Pages;

use Modules\ConversationChannel\Filament\Panel\Admin\ConversationChannelResource;

class EditConversationChannel extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = ConversationChannelResource::class;
}
