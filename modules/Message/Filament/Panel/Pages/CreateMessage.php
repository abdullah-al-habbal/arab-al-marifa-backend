<?php

declare(strict_types=1);

namespace Modules\Message\Filament\Panel\Pages;

use Modules\Message\Filament\Panel\MessageResource;

class CreateMessage extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = MessageResource::class;
}
