<?php
declare(strict_types=1);

namespace Modules\ConversationChannel\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\ConversationChannel\Filament\Panel\ConversationChannelResource;

class ViewConversationChannel extends ViewRecord
{
    protected static string $resource = ConversationChannelResource::class;
}
