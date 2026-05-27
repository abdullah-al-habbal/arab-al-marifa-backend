<?php
declare(strict_types=1);

namespace Modules\ConversationChannel\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\ConversationChannel\Filament\Panel\Admin\ConversationChannelResource;

class ViewConversationChannel extends ViewRecord
{
    protected static string $resource = ConversationChannelResource::class;
}
