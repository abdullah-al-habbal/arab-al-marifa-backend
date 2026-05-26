<?php
declare(strict_types=1);

namespace Modules\Message\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Message\Filament\Panel\MessageResource;

class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;
}
