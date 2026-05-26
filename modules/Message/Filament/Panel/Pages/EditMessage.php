<?php

declare(strict_types=1);

namespace Modules\Message\Filament\Panel\Pages;

use Modules\Message\Filament\Panel\MessageResource;

class EditMessage extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = MessageResource::class;
}
