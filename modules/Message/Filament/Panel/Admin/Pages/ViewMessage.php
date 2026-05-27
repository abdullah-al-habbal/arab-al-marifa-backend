<?php
declare(strict_types=1);

namespace Modules\Message\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Message\Filament\Panel\Admin\MessageResource;

class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;
}
