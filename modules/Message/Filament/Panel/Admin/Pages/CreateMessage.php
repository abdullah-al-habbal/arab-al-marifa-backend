<?php

declare(strict_types=1);

namespace Modules\Message\Filament\Panel\Admin\Pages;

use Modules\Message\Filament\Panel\Admin\MessageResource;

class CreateMessage extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = MessageResource::class;
}
